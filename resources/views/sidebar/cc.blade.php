<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Work Links <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a class="btn" href="{{ url('/extension') }}">Extension</a>
        </li>
        <li>
            <a class="btn" href="{{ url('/refund') }}">Refund</a>
        </li>
        <li>
            <a class="btn" href="{{ url('/downArea') }}">Down Area</a>
        </li>
        <li>
            <a class="btn" href="{{ url('/feasibleArea') }}">Feasibility</a>
        </li>
        @if (auth()->user()->user_type == 'admin')
            <li>
                <a class="btn" href="{{ url('/addNewConsumer') }}">New Consumer</a>
            </li>
        @endif
    </ul>
</li>