<h3>Are you sure you want to delete this?</h3>
<p>This will delete the entry as well as any localization saved along with it. Please confirm your decision:</p>
<form method='post' action='/math/{{ $math->id }}/delete'>
	<input type='hidden' name='id' value='{{ $math->id }}'>
	<input type='hidden' name='confirm' value='true'>
	<input type='submit' value='Confirmed, Delete it' class='btn'>
	<a href='/math/{{ $math->id }}' class='btn'>No, don't delete it</a>
</form>