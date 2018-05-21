// JavaScript Document
function listFunctions() {
	"use strict";
	var list = [];
	var text, i, holder, low, high,len;
	$("#getSpintax").click(function () {
		getList();
		var content= "";
		$.each(list, function (index,value){
			if(index>0){
				content += "|";
			}
			content += value;
		});
		text = "{" + content + "}";
		$("#spin").val(text);
		fieldUpdate();
	});
	$("#commas").click(function () {
		getList();
		var content= "";
		$.each(list, function (index,value){
			if(index>0){
				content += ",";
			}
			content += value;
		});
		$("#spin").val(content);
		fieldUpdate();
	});
	$("#randomize").click(function () {
		getList();
		var content= "";
		$.each(list, function (index,value){
			if(index>0){
				content += "\n";
			}
			content += value;
		});
		$("#spin").val(content);
		fieldUpdate();
	});

	function getList() {
		var newList = $('#decode').val().replace(/(\r\n|\n|\r)/gm, ",");
		list = newList.split(',');
		len = list.length;
		random();
	}

	function random() {
		low = parseInt($('#low').val());
		console.log( low );
		if (low.length < 1 || low<1 || isNaN(low)) {
			low = 1;
		}
		high = parseInt($('#high').val());
		if (high.length < 1 || isNaN(high)) {
			high = list.length;
		}
		if(high>len){high=len;}
		var area = high-low+1;
		var newLength = Math.floor(Math.random() * area) + low;
		list = list.splice(0,newLength);
		list = shuffle(list);
	}
	//Utility functions
	$('#clear').click(function () {
		$("#spin").val('');
		$("#decode").val('');
		fieldUpdate();
	});
	$('#spin').simplyCountable({
		counter: '#counter',
		countType: 'characters',
		maxCount: 500
	});
	$("#copy").click(function () {
		$("#spin").select();
		document.execCommand('copy');
	});

	function fieldUpdate() {
		$('#lines').text(i);
		autosize.update($('#spin'));
		autosize.update($('#decode'));
		$('#spin').blur();
	}

	function outputList(text) {
		$("#spin").val('');
		holder = "";
		i = 0;
		while (text[i]) {
			holder += text[i];
			if (i < text.length - 1) {
				holder += '\n';
			}
			i++;
			console.log(i + " - " + text[i]);
		}
		$("#spin").val(holder);
		fieldUpdate();
	}
}
function shuffle (array) {
  var i = 0
    , j = 0
    , temp = null

  for (i = array.length - 1; i > 0; i -= 1) {
    j = Math.floor(Math.random() * (i + 1))
    temp = array[i]
    array[i] = array[j]
    array[j] = temp
  }
	return array;
}