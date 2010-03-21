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

$.jsonRpc = function(options)
{
    return new (function(options)
    {
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
                        var requestData = {
                            jsonrpc: '2.0',
                            method: method,
                            params: arguments,
                            id: self.lastId
                        };
                        var reply = {};

                        // do the AJAX request
                        $.ajax({
                            contentType: 'application/json',
                            url:         options.url,
                            type:        'post',
                            dataType:    'json',
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
    })(options);
};

})(jQuery);
