<li>
    <a href="{{ url('/newConnectionForm') }}">New Connection</a>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        ILL Links <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/internetLeasedLine') }}">New Requests</a>
        </li>
        <li>
            <a href="{{ url('/internetLeasedLineFeasibleRequests') }}">Feasible Requests</a>
        </li>
        <li>
            <a href="{{ url('/illForwardedRequests') }}">Final Approval ILL Requests</a>
        </li>
        <li>
            <a href="{{ url('/illRequests') }}">Processed ILL Requests</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Manage Services <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/p2pNewRequests') }}">New Requests</a>
        </li>
        <li>
            <a href="{{ url('/p2pFeasibleRequests') }}">Feasible Requests</a>
        </li>
        <li>
            <a href="{{ url('/p2pForwardedRequests') }}">Final Approval P2P Requests</a>
        </li>
        <li>
            <a href="{{ url('/p2pRequests') }}">Processed P2P Requests</a>
        </li>
    </ul>
</li>
