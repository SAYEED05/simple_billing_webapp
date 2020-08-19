var express = require('express');
var app = express();
var bodyParser = require("body-parser");
var mongoose = require("mongoose");
var passport = require("passport");
var LocalStrategy = require("passport-local");
var flash = require("connect-flash");
var methodOverride = require("method-override");
// var User = require("./models/user");


mongoose.connect("mongodb://localhost/billinfo", {
    useUnifiedTopology: true,
    useNewUrlParser: true,
    useFindAndModify: true,
});


app.use(bodyParser.urlencoded({ extended: true }));
app.set('view engine', 'ejs');
app.use(express.static(__dirname + "/public"));
app.use(methodOverride("_method"));
app.use(flash());

/*
//PASSPORT CONFIG
app.use(require("express-session")({
    secret: "test",
    resave: false,
    saveUninitialized: true
}));
app.use(passport.initialize());
app.use(passport.session());
passport.use(new LocalStrategy(User.authenticate()));
passport.serializeUser(User.serializeUser());
passport.deserializeUser(User.deserializeUser());

app.use(function (req, res, next) {
    res.locals.currentUser = req.user;
    res.locals.error = req.flash("error");
    res.locals.success = req.flash("success");
    next();
});
 */

//SCHEMA SETUP
var billinfoSchema = new mongoose.Schema({
    name: String,
    price: String,
    quantity: String,
    discount: String,
    subtotal: String,

});

var billinfo = mongoose.model("billinfo", billinfoSchema);

app.get('/', function (req, res) {
    res.render('shopping');
});

app.get('/addnew', function (req, res) {
    res.render('addnew');
});

var port_number = app.listen(process.env.PORT || 3000);
app.listen(port_number, function () {
    console.log('server started');
});
