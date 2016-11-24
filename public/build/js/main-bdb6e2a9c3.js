(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

// import Vue from 'vue';

var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!'
  }
});

// new Vue({

//   el: '#app',

//   // Here we can register any values or collections that hold data
//   // for the application
//   data: {
//   	message: 'Hello Vue!'
//   },

//   // Anything within the ready function will run when the application loads
//   ready: function() {
//   },

//   // Methods we want to use in our application are registered here
//   methods: {
//   },

//   computed: {
//   }


// });

},{}]},{},[1]);

//# sourceMappingURL=main.js.map
