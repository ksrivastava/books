var rootUrl = "http://sites/books/php";
var users;
var isbn = new Array(
	9788466626767,
	9781594483851,
	9788478888566,
	9780060838218,
	9780141976969
);

var pass = "testpass";

function start() {
	init();
	createUsers();
	insertBooks();
	lookupBooks();
	listUserBooks();
	deleteBooks();
	deleteUsers();
}

function init() {
	users = new Array();
	for (var i = 0; i < 5; i++) {
		users[i] = "TestUser"+i;
		//console.log("Creating user: " + users[i]);
	}

}

function createUsers() {
	for (i in users) {
		console.log("inserting: " + users[i]);
		var xmlHttp = null;
		var url = rootUrl + "/create?" + "username="+users[i]+"&password="+pass;
		xmlHttp = new XMLHttpRequest();
    	xmlHttp.open( "GET", url, false );
    	xmlHttp.send( null );
    	console.log(xmlHttp.responseText);
	}
}



function insertBooks() {
	for (i in users) {
		console.log("inserting books: " + users[i]);
		var xmlHttp = null;
		for (j in isbn) {
			if (j == i) continue;
			var url = rootUrl + "/insert?" + "username="+users[i]+"&password="+pass+"&isbn="+isbn[j];
			xmlHttp = new XMLHttpRequest();
	    	xmlHttp.open( "GET", url, false );
	    	xmlHttp.send( null );
	    	console.log(xmlHttp.responseText);
	    }
	}
}

function lookupBooks() {
	for (i in isbn) {
		console.log("lookup books: " + isbn[i]);
		$.ajax({
            type: 'GET',
            url: rootUrl + '/search?' + "isbn="+ isbn[i],
            success: function(data){
            	//console.log(data);
            }
        });
	}
}

function listUserBooks() {
	for (i in users) {
		console.log("home: " + users[i]);
		var xmlHttp = null;
		var url = rootUrl + "/home?" + "username="+users[i]+"&password="+pass;
		xmlHttp = new XMLHttpRequest();
    	xmlHttp.open( "GET", url, false );
    	xmlHttp.send( null );
    	console.log(xmlHttp.responseText);
	}
}

function deleteBooks() {
	for (i in users) {
		console.log("deleting books: " + users[i]);
		var xmlHttp = null;
		for (j in isbn) {
			if (j == i) continue;
			var url = rootUrl + "/delete?" + "username="+users[i]+"&password="+pass+"&isbn="+isbn[j];
			xmlHttp = new XMLHttpRequest();
	    	xmlHttp.open( "GET", url, false );
	    	xmlHttp.send( null );
	    	console.log(xmlHttp.responseText);
	    }
	}
}



function deleteUsers() {
	for (i in users) {
		console.log("deleting: " + users[i]);
		var xmlHttp = null;
		var url = rootUrl + "/deleteUser?" + "username="+users[i]+"&password="+pass;
		xmlHttp = new XMLHttpRequest();
    	xmlHttp.open( "GET", url, false );
    	xmlHttp.send( null );
    	console.log(xmlHttp.responseText);
	}
}