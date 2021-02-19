@extends('layouts.app')
@section('breadcrumb')
   {{ Breadcrumbs::render('revision',$filter, $sow) }}
@endsection
@section('content')
     
    @if (count($errors) > 0)

    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
           @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
           @endforeach
        </ul>
    </div>
    @endif

   
    

    <div class="row">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <table class="mb-0 table table-striped">
                    @if(!empty($revisionHistory[0]))
                            @foreach ($revisionHistory as $key => $history)
                            <?php  //print_r($history); ?>
                            @if($history->key == 'created_at' && $history->old_value==NULL)
                            <tr><td><?php echo $history->userResponsible()->name;?> created this resource at <?php echo date("d M Y, H.i A",strtotime($history->newValue()));?></td></tr>
                            @elseif($history->old_value==NULL)
                            <tr><td>
                            <strong><?php echo $history->userResponsible()->name;?></strong> added <strong><?php echo $history->fieldName();?></strong> as <?php echo $history->newValue();?> on 
                            <strong><?php echo date("d M Y, H.i A",strtotime($history['updated_at']));?></strong>
                            </td></tr>
                            @else
                            <tr><td>
                            <strong><?php echo $history->userResponsible()->name;?></strong> 
                            changed <strong><?php echo $history->fieldName();?></strong> 
                            from <?php if($history->fieldName() == 'status') echo Lang::get('status.'.$history->oldValue()); else echo $history->oldValue();  ?> 
                            to <?php if($history->fieldName() == 'status') echo Lang::get('status.'.$history->newValue());else echo $history->newValue(); ?> on 
                            <strong><?php echo date("d M Y, H.i A",strtotime($history['updated_at']));?></strong>
                            </td></tr>
                            @endif
                            @endforeach
                    @else
                        <tr>
                            <td>No data found</td>
                        </tr>
                    @endif  
                </table>
            </div>
        </div>
    </div>
</div>
{!! $revisionHistory->render() !!}
@endsection
