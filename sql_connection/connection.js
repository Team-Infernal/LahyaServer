import dotenv from "dotenv";
dotenv.config();
import mysql from 'mysql2';
export default mysql.createConnection({
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: "lahya"
});


