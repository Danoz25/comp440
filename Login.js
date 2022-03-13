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
    const loginbtn = document.getElementById("log").onclick = function ()
    {

    };

}
const connection = mysql.createConnection({
	host     : 'localhost',
	user     : 'root',
	password : '',
	database : 'nodelogin'
});

