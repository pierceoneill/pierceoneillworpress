"use strict";
var system = require('system');
if (system.args.length === 1) {
    phantom.exit();
}
var page = require("webpage").create(),
    url = system.args[1];
page.settings.resourceTimeout = system.args[2];
if(system.args[3] != 'default')
{
    page.settings.userAgent = system.args[3];
}
if(system.args[4] != 'default')
{
    document.cookie = system.args[4];
}
page.onResourceTimeout = function(e) {
  console.log('timeout');
  phantom.exit(1);
};
function onPageReady() {
    var htmlContent = page.evaluate(function () {
        return document.documentElement.outerHTML;
    });
    console.log(htmlContent);
    phantom.exit();
}

page.onError = function(msg, trace) {
    var msgStack = ['ERROR: ' + msg];
    if (trace && trace.length) {
        msgStack.push('TRACE:');
        trace.forEach(function(t) {
            msgStack.push(' -> ' + t.file + ': ' + t.line + (t.function ? ' (in function "' + t.function + '")' : ''));
        });
    }
    // uncomment to log into the console 
    // console.error(msgStack.join('\n'));
};
page.open(encodeURI(url), function (status) {
    function checkReadyState() {
        setTimeout(function () {
            var readyState = page.evaluate(function () {
                return document.readyState;
            });

            if ("complete" === readyState) {
                onPageReady();
            } else {
                checkReadyState();
            }
        });
    }
    checkReadyState();
});