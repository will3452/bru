<form action="/test" method="POST" style="border:2px solid #222">
        <h1>ADD CRYSTAL</h1>
        @csrf
        <div>
            Enter Email
            <input type="email" name="email">
        </div>
        <div>
            Enter Value
            <input type="number" name="value">
        </div>
        <div>
            <button>
                Submit
            </button>
        </div>
    </form>
    @if (session('success'))
        Added!
    @endif