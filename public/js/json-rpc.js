/**
 * Firal
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://firal.org/licenses/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to firal-dev@googlegroups.com so we can send you a copy immediately.
 */
(function($) {

$.jsonEncode = function(input)
{
    // check if we are dealing with an object
    if (typeof(input) == 'object') {
        // ECMAScript isn't nice
        if (!input) {
            return 'null';
        }
        // arrays are a little bit different than objects
        if (Object.prototype.toString.apply(input) == '[object Array]') {
            var output = [];
            $.each(input, function(key, value)
            {
                output.push($.jsonEncode(value));
            });
            return '[' + output.join(',') + ']';
        } else {
            var output = [];
            $.each(input, function(key, value)
            {
                output.push('"' + key + '":' + $.jsonEncode(value));
            });
            return '{' + output.join(',') + '}';
        }
    } else {
        return '"' + input + '"';
    }
};

$.jsonRpc = function(options)
{
    return new (function(options)
    {
        var defaults = {
            url: "/"
        };

        var options = $.extend(defaults, options);

        // self-reference for the returned object
        var self = this;

        // keep track of our request ID's
        this.lastId = 1;

        // do an ajax request to get the SMD from tje JSON-RPC server
        $.ajax({
            contentType: 'application/json',
            url:         options.url,
            type:        'get',
            dataType:    'json',
            // the browser may cache this request, the service map shouldn't change at all
            cache:       true,
            success: function(data)
            {
                // build the callback methods
                $.each(data.methods, function(method, val)
                {
                    self[method] = function()
                    {
                        // we want a parameter array, not an object
                        var params = [];

                        $.each(arguments, function(key, val)
                        {
                            params.push(val);
                        });

                        // the request data to send
                        var requestData = {
                            jsonrpc: '2.0',
                            method:  method,
                            params:  params,
                            id:      self.lastId
                        };


                        var reply = {};

                        // do the AJAX request
                        $.ajax({
                            contentType: 'application/json',
                            url:         options.url,
                            type:        'post',
                            dataType:    'json',
                            data:        $.jsonEncode(requestData),
                            // this one should not be cached by the browser
                            cache:       false,
                            success: function(data)
                            {
                                reply = data;
                            }
                        });
                        return reply;
                    }
                });
            }
        });

        // return the newly created object
        return this;
    })(options);
};

$.getService = function(module, service, options)
{
    var defaults = {
        url: "/"
    };

    var options = $.extend(defaults, options);

    options.url = options.url + "/" + module + "/" + service;

    return $.jsonRpc(options);
};

})(jQuery);
