@if(!empty($data[0]))
            <ul class="timeline">
                @foreach($data as $key => $transition)
                    <li>
                      <div class="timeline-badge {{trans('timeline.badge.'.$transition->to_status)}}"><i class="{{trans('timeline.icon.'.$transition->to_status)}}"></i></div> <!-- timeline-badge primary success warning danger info -->
                      <div class="timeline-panel card">
                        <div class="timeline-heading">
                                <h6 class="timeline-title">{!! trans('timeline.string.'.$transition->to_status, ['creator' => $transition->creator->name]) !!}</b></h6>
                          <p><small class="text-muted"><i class="pe pe-7s-timer"></i>at {{date('d M Y, H.i A',strtotime($transition->created_at))}}</small></p>
                        </div>

                        @if($transition->comment  != '') 
                              <div id="collapse{{$transition->id}}">
                                  <div class="timeline-body">
                                    <p><b>Comment: </b>{{$transition->comment->comments}}</p>
                                  </div>
                              </div>
                        @endif
                      </div>
                    </li>       
                @endforeach
            </ul>
            @else

            <div class="card mb-3">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body ml-4">
                            <h4 class="text-center">No Events Performed</h4>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    
{!! $data->render() !!}