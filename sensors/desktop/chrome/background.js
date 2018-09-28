// Copyright 2018 The Precogers

'use strict';

chrome.tabs.onUpdated.addListener(function() {
	chrome.tabs.query({'active': true, 'lastFocusedWindow': true}, function (tabs) {
		var url = tabs[0].url;
		var xhr = new XMLHttpRequest();
		//xhr.open("POST", "http://www.precok.org/myurl.php", false); // chrome says: Synchronous XMLHttpRequest on the main thread is deprecated because of its detrimental effects to the end user's experience. For more help, check https://xhr.spec.whatwg.org/.
		xhr.open("POST", "http://www.precok.org/myurl.php", true);
		xhr.setRequestHeader('Content-Type', 'application/json');
		var data = '{"id":"test","url":"'+url+'"}';
		xhr.send(data);
		var result = xhr.responseText;
	});
});
