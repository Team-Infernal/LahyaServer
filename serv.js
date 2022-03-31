import morgan from "morgan";
import express from "express";
import bodyParser from "body-parser";
import cookieParser from "cookie-parser";
import cors from "cors";

import connection from "./sql_connection/connection.js";

const app = express();
const port = 3002;

const tables = [
    "activity_domain",
    "address",
    "application",
    "company",
    "grades_by_students",
    "internship",
    "permission",
    "role",
    "users",
]

/* middleware used by the server */
app.use(cors({ credentials: true }));
app.use(morgan('tiny'));
app.use(bodyParser.json()); 
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cookieParser()); 

connection.connect(err => {
    if (err) throw err;
    console.log("Connection with MySQL established.");
}); 

const getCookie = req => {
    if (req.cookies.hasOwnProperty("loggedin")) return req.cookies.loggedin;
    else return false;
}

const badRequest = res => {
    res.status(400).send({});
}

app.get('/api/:table/:id', (req, res) => { //request used to select one element in a specified table
    // if(!getCookie(req)) return badRequest(res);
    const { table, id } = req.params;
    //if (!tables.includes(table)) return badRequest(res);
    const selectOneQuery = `SELECT * FROM ${table} WHERE id=?`;
    connection.query(selectOneQuery, id , (err, result) => {
        if (err) res.status(404).send({});
        res.send(result);
    }); 
});

app.get('/api/:table/email/:email', (req, res) => { //request used to select one element in a specified table
    // if(!getCookie(req)) return badRequest(res);
    const { table, email } = req.params;
    //if (!tables.includes(table)) return badRequest(res);
    const selectOneQuery = `SELECT * FROM ${table} WHERE login=?`;
    connection.query(selectOneQuery, email , (err, result) => {
        if (err) res.status(404).send({});
        res.send(result);
    });
});

app.get('/api/:table', (req, res) => { //request used to select all elements in a specified table
    // if(!getCookie(req)) return badRequest(res);
    const table = req.params.table;
    //if (!tables.includes(table)) return badRequest(res);
    const selectAllQuery = `SELECT * FROM ${table};`;
    connection.query(selectAllQuery, (err, result) => {
        if (err) res.status(404).send({});  
        res.send(result); 
    });
});    

app.get('/api/users/:id/wishlists', (req,res) => {
    console.log("bob")
    const id = req.params.id;
    const selectWishlistFromId = `SELECT * FROM wishlists as w INNER JOIN internship as i ON w.id_internship = i.id WHERE i.id = ?`;
    connection.query(selectWishlistFromId, id, (err, result) => {
        if(err) res.status(404).send({err});
        res.send(result);    
    })

})

app.post('/api/:table', (req,res) => { //insert values from http body into a specified table 
    // if(!getCookie(req)) return badRequest(res);
    const table = req.params.table;
    const enable = `SET FOREIGN_KEY_CHECKS=1;`;
    const disable = `SET FOREIGN_KEY_CHECKS=0;`;
    //if (!tables.includes(table)) return badRequest(res);
    let data = req.body;
    if (!data) res.send({
        status: 400,
        message: "Bad body, try again"
    });
    const columnsQuery = `DESCRIBE ${table}`;    
    let insertQuery; 
    connection.query(disable, (err, result) => {
        if(err) res.send(err);
        connection.query(columnsQuery, (err, result) => {
            if (err) throw err;
            if(table !== "wishlists") result.shift();
            result = result.map(val => val.Field);
            data = Object.values(data);
            insertQuery = `INSERT INTO ${table} (${result.join(',')}) VALUES (${"?, ".repeat(data.length).slice(0,-2)})`;
            connection.query(insertQuery, data, (err, result) => {
                if (err) {
                    console.log(err);
                    res.status(400).send("Wrong data entered");
                }
                res.send(result);
                connection.query(enable, (err, result) => {
                    if(err) res.send(err)   
                })   
            });   
        }); 

    })
}); 

app.put('/api/:table/:id', (req, res) => { //update
    // if(!getCookie(req)) return badRequest(res);
    const { table, id } = req.params;
    let data = req.body;
    if (!data) res.send({
        status: 400,
        message: "Bad body, try again"
    });
    const columnsQuery = `DESCRIBE ${table}`;
    connection.query(columnsQuery, (err, result) => {
        if (err) res.status(400).send({});
        result.shift();
        result = result.map(val => val.Field);
        data = Object.values(data);
        if (data.length !== result.length) res.send("wrong data size"); 
        data.push(id);
        let tempString = "";
        for (let i = 0; i < data.length -1; i++) {
            tempString += `${result[i]} = ?, `;
        }
        const updateQuery = `UPDATE ${table} SET ${tempString.slice(0,-2)} WHERE id = ?`;
        connection.query(updateQuery, data, (err, result) => {
            if (err) badRequest(res);
            else res.send(result);
        });
    });
});

app.delete('/api/:table/:id', (req,res) => {
    const { table, id } = req.params;
    const disable = `SET FOREIGN_KEY_CHECKS=0;`;
    const deleteQuery = `DELETE FROM ${table} WHERE id=?;`;
    const enable = `SET FOREIGN_KEY_CHECKS=1;`;
    connection.query(disable, (err,result) => {
        if(err) res.status(400).send({err});
        connection.query(deleteQuery, id, (err, result) => {
            if (err) res.status(400).send({err});
            res.send(result);
            connection.query(enable, (err,result) => {
                if(err) res.status(400).send(err);
            });
        });
    });
});

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`);
});