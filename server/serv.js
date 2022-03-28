import connection from "./sql_connection/connection.js";
import express from "express";
import bodyParser from "body-parser";
import cookieParser from "cookie-parser";
const app = express();
const port = 3002;

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));
app.use(cookieParser());


connection.connect(err => {0
    if(err) throw err;
    console.log("Connection with MySQL established...");
});

app.get('/api/:table/:id', (req,res) => { //request used to select one element in a specified table
    const { table, id } = req.params;
    const selectOneQuery = `SELECT * FROM ${table} WHERE id=${id}`;
    connection.query(selectOneQuery, (err, result) => {
        if(err) throw err;
        res.send(result);
    });
});

app.get('/api/:table', (req,res) => { //request used to select all elements in a specified table
    const table = req.params.table;
    const selectAllQuery = `SELECT * FROM ${table}`;
    connection.query(selectAllQuery, (err, result) => {
        if(err) throw err;
        res.send(result);
    });
});

app.post('/api/:table', (req,res) => { //insert values from http body into a specified table 
    const table = req.params.table;
    let data = req.body;
    if(!data) res.send({
        status: 400,
        message: "Bad body, try again"
    });
    const columnsQuery = `DESCRIBE ${table}`;    
    let insertQuery; 
    connection.query(columnsQuery, (err, result) => {
        if(err) throw err;
        result.shift();
        result = result.map(val => val.Field);
        data = Object.values(data);
        if(data.length != result.length) res.send("Wrong data size");
        insertQuery = `INSERT INTO ${table} (${result.join(',')}) VALUES (${"?, ".repeat(data.length).slice(0,-2)})`;
        console.log(insertQuery);
        connection.query(insertQuery, data, (err, result) => {
            if(err) res.send("Wrong data entered");
            res.send(result);
        });
    });
});

app.put('/api/:table/:id', (req, res) => { //update
    let { table, id } = req.params;
    let data = req.body;
    if(!data) res.send({
        status: 400,
        message: "Bad body, try again"
    });
    let updateQuery;
    const columnsQuery = `DESCRIBE ${ table }`;
    connection.query(columnsQuery, (err, result) => {
        if(err) throw err;
        result.shift();
        result = result.map(val => val.Field);
        data = Object.values(data);
        if(data.length !== result.length) res.send("wrong data size");
        data.push(id);
        let tempString = ""
        for(let i = 0; i < data.length-1; i++) {
            tempString += `${result[i]} = ?, `
            console.log(i)   
        }
        updateQuery = `UPDATE ${table} SET ${tempString.slice(0,-2)} WHERE id = ?`;
        connection.query(updateQuery, data, (err, result) => {
            if(err) res.send(err);
            res.send(result);
        });
    });
});

app.delete('/api/:table/:id', (req,res) => {
    const { table, id } = req.params;
    const deleteQuery = `DELETE FROM ${table} WHERE id=${id}`;
    connection.query(deleteQuery, (err, result) => {
        if(err) throw err;
        res.send(result);
    });
});

app.listen(port, () => {
    console.log(`Example app listening on port ${port}`);
});