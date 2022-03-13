const mysql = require('mysql');
const express = require('express');


const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: ''
});

db.connect(err =>{
    if(err){
        throw err
    }
    console.log('MySQL connected')
});

const app = express()

app.get('/createdb', (req, res) => {
    let sql = 'CREATE DATABASE projdb'
    db.query(sql, err => {
        if(err){
            throw err
        }
        res.send('Database Created');
    });
});

app.listen('3000', () => {
    console.log('Server Started on Port 3000')
});