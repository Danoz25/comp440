

var express = require('express');
var router = express.Router();
var db=require('/university.sql');

function Completeregi()
{


const submitregister = document.getElementById("complete").onclick = function()

{
// to display registration form 
router.get('/register', function(req, res, next) {
  res.render('registration-form');
});

// to store user input detail on post request
router.post('/register', function(req, res, next) {
    
    inputData ={
        username: req.body.username,
        password: req.body.password,
        firstName: req.body.firstName,
        lastName: req.body.lastName,
        email: req.body.email
    }
// check unique email address
    var sql='SELECT * FROM registration WHERE email_address =?';
    db.query(sql, [inputData.email] ,function (err, data, fields) {
    if(err) throw err
    if(data.length>1){
         var msg = inputData.email_address+ "was already exist";
    }else{
     
    // save users data into database
    var sql = 'INSERT INTO registration SET ?';
   db.query(sql, inputData, function (err, data) {
      if (err) throw err;
           });
  var msg ="Your are successfully registered";
 }
 res.render('registration-form',{alertMsg:msg});
})
     
});
        module.exports = router;

    };
    location.href = "http://127.0.0.1:5500/index.html";


}