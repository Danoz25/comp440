const loginbtn = document.getElementById("log");
const registerbtn = document.getElementById("register");
const mysql = require('universitysql');
const express = require('express');
const session = require('express-session');
const path = require('path');


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

    
    var express = require('express');
    var router = express.Router();
    var db=require('../database');
    /* GET users listing. */
    router.get('/login', function(req, res, next) {
      res.render('login-form');
    });
    
    router.post('/login', function(req, res){
        var emailAddress = req.body.email_address;
        var password = req.body.password;
    
        var sql='SELECT * FROM registration WHERE email_address =? AND password =?';
        db.query(sql, [emailAddress, password], function (err, data, fields) {
            if(err) throw err
            if(data.length>0){
                req.session.loggedinUser= true;
                req.session.emailAddress= emailAddress;
                res.redirect('/dashboard');
            }else{
                res.render('login-form',{alertMsg:"Your Email Address or password is wrong"});
            }
        })
    
    })
    
    module.exports = router;
    };
    location.href = "http://127.0.0.1:5500/Initialize.html";




}