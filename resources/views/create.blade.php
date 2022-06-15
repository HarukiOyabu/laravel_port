<form method='POST' action={{ route('home.create') }}>
    @csrf
    <input type='text' name='comment'>
    <input type='submit' value='send'>
</form>