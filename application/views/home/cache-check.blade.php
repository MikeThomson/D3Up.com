<h2>Cache Check</h2>
<ul>
	<li>Cookie: {{ Cookie::get('d3up_user', 'null') }}</li>
	<li>Time: {{ microtime(true) }}</li>
	<li>Logged in: {{ Auth::check() }}</li>
</ul>
@render('user.login.form')
<a href="/logout">Logout</a>