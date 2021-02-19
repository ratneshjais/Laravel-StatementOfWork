
<div class="container-fluid" style="margin-top: -50px;">
  <br /><br />
  <ul class="list-unstyled multi-steps">
  	<li {{ request()->route()->parameters["step"] =="1"  ? 'class=is-active' : '' }}>
      <a href="{{ route('sowEdit', ['filter'=>request()->route()->parameters['filter'], 'id' => request()->route()->parameters['id'], 'step' => 1]) }}">
        First Step
      </a>
    </li>
    <li {{ request()->route()->parameters["step"] =="2"  ? 'class=is-active' : '' }}>
      <a href="{{ route('sowEdit', ['filter'=>request()->route()->parameters['filter'], 'id' => request()->route()->parameters['id'], 'step' => 2]) }}">
        Second Step
      </a>
    </li>
    <li {{ request()->route()->parameters["step"] =="3"  ? 'class=is-active ' : '' }}>
      <a href="{{ route('sowEdit', ['filter'=>request()->route()->parameters['filter'], 'id' => request()->route()->parameters['id'], 'step' => 3]) }}">
        Third Step
        </a>
    </li>
    <li {{ request()->route()->parameters["step"] =="4"  ? 'class=is-active' : '' }}>
      <a href="{{ route('sowEdit', ['filter'=>request()->route()->parameters['filter'], 'id' =>   request()->route()->parameters['id'], 'step' => 4]) }}">
      Fourth Step
      </a>
    </li>
    <li {{ request()->route()->parameters["step"] =="5"  ? 'class=is-active' : '' }}>
      <a href="{{ route('sowEdit', ['filter'=>request()->route()->parameters['filter'], 'id' => request()->route()->parameters['id'], 'step' => 5]) }}">
        Annexure
      </a>
    </li>
    <li {{ request()->route()->parameters["step"] =="6"  ? 'class=is-active' : '' }}>Authorization</li>
    <li>Finish</li>
  </ul>
</div>