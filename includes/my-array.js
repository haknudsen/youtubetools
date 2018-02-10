// JavaScript Document

function textToArray(myArray) {
        "use strict";
        myArray = myArray.split("\n");
        myArray = myArray.filter(function (value) {
            return value !== "" && value !== null;
        });
        return myArray;
    }

