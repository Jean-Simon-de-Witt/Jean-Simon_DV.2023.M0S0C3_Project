<div class="alert">
    <p class="alert-title">{{$alert_title}}</p>
    <p class="alert-text">{{$alert_text}}</p>
    <form action="{{$action}}" method="POST">
        @csrf
        @method($method)
        <div class="alert-buttons">
            <button class="alert-button" type="submit">{{$command}}</button>
            <button class="alert-button cancel-button" onclick="closeAlert">Cancel</button>
        </div>
    </form>
</div>