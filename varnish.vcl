backend default {
    .host = "127.0.0.1";
    .port = "8080";
}

sub vcl_recv {
  if (req.request != "GET" &&
    req.request != "HEAD" &&
    req.request != "PUT" &&
    req.request != "POST" &&
    req.request != "TRACE" &&
    req.request != "OPTIONS" &&
    req.request != "DELETE") {
      /* Non-RFC2616 or CONNECT which is weird. */
      return (pipe);
  }
  if (req.request != "GET" && req.request != "HEAD") {
      /* We only deal with GET and HEAD by default */
      return (pass);
  }
	if (req.url ~ "^/login$") {
		return (pipe);
	}
  return (pass);	
}

sub vcl_fetch {
	set beresp.ttl = 1m;
	unset beresp.http.Cache-Control;
	unset req.http.Cache-Control;
	# Varnish determined the object was not cacheable
	if (beresp.ttl <= 0s) {
		set beresp.http.X-Cacheable = "NO:Not Cacheable";
		return(hit_for_pass);
	# You don't wish to cache content for logged in users
	} elsif (req.http.Cookie ~ "(d3up_user)") {
		set beresp.http.X-Cacheable = "NO:Got User";
		return(hit_for_pass);
	# You are respecting the Cache-Control=private header from the backend
	} elsif (beresp.http.Cache-Control ~ "private") {
		set beresp.http.X-Cacheable = "NO:Cache-Control=private";
		return(hit_for_pass);
	}		
	# Varnish determined the object was cacheable
	unset beresp.http.Set-Cookie;
	unset req.http.Cookie;
	set beresp.http.X-Cacheable = "YES";
	return(deliver);
}