@include('sidebar.noc')
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Reports <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/listExtensions') }}">Extension</a>
        </li>
        <li>
            <a href="{{ url('/listRefunds') }}">Refunds</a>
        </li>
        <li>
            <a href="{{ url('/listDownAreas') }}">Down Areas</a>
        </li>
        <li>
            <a href="{{ url('/listClosedDownAreas') }}">Closed Down Areas</a>
        </li>
        <li>
            <a href="{{ url('/listFeasibleAreas') }}">Feasible Area</a>
        </li>
    </ul>
</li>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
        Work Links <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ url('/extension') }}">Extension</a>
        </li>
        <li>
            <a href="{{ url('/refund') }}">Refund</a>
        </li>
        <li>
            <a href="{{ url('/downArea') }}">Down Area</a>
        </li>
        <li>
            <a href="{{ url('/feasibleArea') }}">Feasible Area</a>
        </li>
    </ul>
</li>