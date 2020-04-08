# API | REST | RESTFUL

## Mock Service
> https://jsonplaceholder.typicode.com/
http://mockbin.org/
https://www.mocky.io/
https://www.mockable.io/

Method Definitions
GET
HEAD
POST
PUT

CONNECT
OPTIONS
TRACE



# HTTP Status Codes 
###### REF.: (https://httpstatuses.com)



| Category | Description|
| --------------------- | --------------|
| 1xx: Informational| Communicates transfer protocol-level information. |
| 2xx: Success| Indicates that the client’s request was accepted successfully. |
| 3xx: Redirection | Indicates that the client must take some additional action in order to complete their request. |
| 4xx: Client Error| This category of error status codes points the finger at clients. |
| 5xx: Server Error| The server takes responsibility for these error status codes. |


## REST Status Codes

- 200 OK
 - Generic response to the success of a client request for REST API, must include a message-body; in your response, can be used only in:
GET - the requested resource are sent in the response wit any message-body;
HEAD - the entity-header fields corresponding to the requested resource are sent in the response without any message-body;
POST - an entity describing or containing the result of the action;
TRACE - an entity containing the request message as received by the end server.
- 201 (Created)
 - A REST API responds with the 201 status code whenever a resource is created. If the action cannot be carried out immediately, the server SHOULD respond with a 202 (Accepted) response instead.
- 202 (Accepted)
 - Response is typically used for actions that take a long while to process.
- 204 (No Content)
 - The 204 status code is usually sent out in response to a PUT, POST, or DELETE request when the REST API declines to send back any status message or representation in the response message’s body.
- 301 (Moved Permanently)
  - The REST API should specify the new URI in the response’s Location header, and all future requests should be directed to the given URI.
- 302 (Found)
 - The 302 (Found) status code indicates that the target resource
   resides temporarily under a different URI.  Since the redirection
   might be altered on occasion, the client ought to continue to use the
   effective request URI for future requests.
   The server SHOULD generate a Location header field in the response
   containing a URI reference for the different URI.  The user agent MAY
   use the Location field value for automatic redirection.  The server's
   response payload usually contains a short hypertext note with a
   hyperlink to the different URI(s).

      Note: For historical reasons, a user agent MAY change the request
      method from POST to GET for the subsequent request.  If this
      behavior is undesired, the 307 (Temporary Redirect) status code
      can be used instead. [from origin](https://tools.ietf.org/html/rfc7231#page-56)
- 303 See Other
 - indicates the server is a resource redirector, to another URI, sent the same in the Location header field. A user agent can perform a retrieval request targeting that URI (a GET or HEAD request if using HTTP), which might also be redirected, and present the eventual  result as an answer to the original request.  Note that the new URI in the Location header field is not considered equivalent to the effective request URI.
- 304 (Not Modified)
 - This status code is similar to 204 (“No Content”) in that the response body must be empty. The critical distinction is that 204 is used when there is nothing to send in the body, whereas 304 is used when the resource has not been modified since the version specified by the request headers If-Modified-Since or If-None-Match. [from origin](https://restfulapi.net/http-status-codes/)
- 307 (Temporary Redirect)
 -  The 307 (Temporary Redirect) status code indicates that the target
   resource resides temporarily under a different URI and the user agent
   MUST NOT change the request method if it performs an automatic
   redirection to that URI.  Since the redirection can change over time,
   the client ought to continue using the original effective request URI
   for future requests.
- 400 (Bad Request)
 - 400 is the generic client-side error status, used when no other 4xx error code is appropriate. Errors can be like malformed request syntax, invalid request message parameters, or deceptive request routing etc.
 The client SHOULD NOT repeat the request without modifications.
 [from origin](https://restfulapi.net/http-status-codes/)
- 401 (Unauthorized)
 - A error response indicates that the client tried to operate on a protected resource without providing the proper authorization.
- 403 (Forbidden)
 - A 403 error response indicates that the client’s request is formed correctly, but the REST API refuses to honor it, i.e. the user does not have the necessary permissions for the resource. A 403 response is not a case of insufficient client credentials; that would be 401 (“Unauthorized”).
- 404 (Not Found)
 - indicates that the REST API does not find a current representation for the target resource or is not willing to disclose that it exists.
 A 404 status code does not indicate whether this lack of representation is temporary or permanent; the 410 (Gone) status code is preferred over 404 if the origin server knows, presumably through some configurable means, that the condition is likely to be permanent.
- 405 Method Not Allowed
 - client tried to use an HTTP method that the resource does not allow.
- 406 Method Not Allowed
 - The Client used the Accept header to inform a preferred media type. The status code inform responds that it only accepts media application / json.
- The 410 (Gone) status code indicates that access to the target
   resource is no longer available at the origin server and that this
   condition is likely to be permanent.  If the origin server does not know, or has no facility to determine, whether or not the condition is permanent, the status code 404 (Not Found) ought to be used instead.
- 412 Precondition Failed
 - client specified one or more preconditions in its request headers to carry out. Case that those conditions were not met, so instead of carrying out the request, the API sends this status code.
- 415 Unsupported Media Type
 - For example, a client request including data formatted as an application/xml will receive a response will be an error, as it only supports processing data formatted as an application/json.
- 500  Internal Server Error 
 - API response is the generic error message, given when an unexpected condition was encountered and no more specific message is suitable.  Most web frameworks automatically respond with this response status code whenever they execute some request handler code that raises an exception.
- 501 (Not Implemented)
- API response is the generic error message, given when usually, this implies future availability



















