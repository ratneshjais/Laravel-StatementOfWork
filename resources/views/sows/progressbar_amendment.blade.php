
<div class="container-fluid" style="margin-top: -50px;">
  <br /><br />
  <ul class="list-unstyled multi-steps">
  	<li {{ request()->route()->parameters["step"] =="1"  ? 'class=is-active' : '' }}>First Step</li>
    <li {{ request()->route()->parameters["step"] =="2"  ? 'class=is-active' : '' }}>Authorization</li>
    <li>Finish</li>
  </ul>
</div>