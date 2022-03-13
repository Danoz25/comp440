const mysql = require('mysql');
const express = require('express');
const path = require('path');


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

function openRegisterForm()
{
    const registerbtn = document.getElementById("register").onclick = function ()
    {
        location.href = "http://127.0.0.1:5500/Register.html";
    };


}

function LoginHere()
{
    const loginbtn = document.getElementById("log").onclick = function()
    {
        location.href = "http://127.0.0.1:5500/Initialize.html";
   
    };
  




}