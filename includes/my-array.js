// JavaScript Document
$.fn.extend({
    textToArray: function (myArray) {
        "use strict";
        myArray = myArray.split("\n");
        myArray = myArray.filter(function (value) {
            return value !== "" && value !== null;
        });
    }
});
