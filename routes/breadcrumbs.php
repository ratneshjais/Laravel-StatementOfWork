<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Dashboard', route('home'));
});

Breadcrumbs::for('sowCreate', function ($trail) {
    $trail->parent('home');
    $trail->push('SOW');
    $trail->push('Create');
});

// Home > Draft|Inprogress|Rejected|Approved
Breadcrumbs::for('sowslist', function ($trail , $filter) {
    $trail->parent('home');
    $trail->push(ucwords($filter), route('sowslist', $filter));
});


// Home > Draft|Inprogress|Rejected|Approved > edit > step 1|2|..
Breadcrumbs::for('sowEdit', function ($trail, $filter, $sow, $step ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('sowEdit',['filter'=>$filter,'id'=>$sow->id,'step'=>$step] ));
    $trail->push("Step ". $step, route('sowEdit',['filter'=>$filter,'id'=>$sow->id,'step'=>$step] ));
});
//Annexure
Breadcrumbs::for('sowAnnex', function ($trail, $filter, $sow, $step ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('sowEdit',['filter'=>$filter,'id'=>$sow->id,'step'=>$step] ));
    $trail->push("Step ". $step, route('sowEdit',['filter'=>$filter,'id'=>$sow->id,'step'=>$step] ));
    $trail->push("Annexure ");
});
 
// Home > Draft|Inprogress|Rejected|Approvede
Breadcrumbs::for('sowView', function ($trail, $filter, $sow ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->sow_code =='' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('sowView',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push("Show ", route('sowView',['filter'=>$filter,'id'=>$sow->id] ));
});

// Home > Draft|Inprogress|Rejected|Approvede >Upload
Breadcrumbs::for('sowViewUpload', function ($trail, $filter, $sow ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('sowView',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push("Show ", route('sowView',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push("Upload ", route('uploaded_file.upload', ['filter'=>$filter, $sow->id]));
});

// Home > Draft|Inprogress|Rejected|Approvede
Breadcrumbs::for('sows_action', function ($trail, $filter, $sow ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $action =  $filter == 'review' ? 'Review' : $filter == 'approve' ? 'Approve' : '';
    $trail->push($identifier, route('sowView',['filter'=>$filter,'id'=>$sow->id] ));
    // $trail->push($action, route('sows_action',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push('Action');
});

Breadcrumbs::for('revision', function ($trail, $filter, $sow ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('revision',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push("Revision ", route('revision',['filter'=>$filter,'id'=>$sow->id] ));
});

Breadcrumbs::for('users.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Manage Users", route('users.index'));
});

Breadcrumbs::for('users.create', function ($trail ) {
    $trail->parent('users.index');
    $trail->push("Create Users", route('users.create'));
}); 

Breadcrumbs::for('users.show', function ($trail, $user ) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.show', $user->id));
    $trail->push("Show", route('users.show', $user->id));
}); 

Breadcrumbs::for('users.edit', function ($trail, $user ) {
    $trail->parent('users.index');
    $trail->push($user->name, route('users.edit', $user->id));
    $trail->push("Edit", route('users.edit', $user->id));
}); 

Breadcrumbs::for('wfCreateWithUser', function ($trail, $user ) {
    $trail->parent('users.edit', $user);
    $trail->push("Workflow", route('wfCreateWithUser', $user->id));
    $trail->push("Add", route('wfCreateWithUser', $user->id));
}); 

 

Breadcrumbs::for('wfEditWithUser', function ($trail,  $workflow, $user) {
    $trail->parent('users.edit', $user);
    $trail->push("Workflow - " .$workflow->project_type->type. " - " . $workflow->role->name, route('wfEditWithUser', $workflow->id));
    $trail->push("Edit", route('wfEditWithUser', $workflow->id));
}); 

Breadcrumbs::for('transaction', function ($trail, $filter, $sow ) {
    $trail->parent('sowslist', $filter);
    $identifier = $sow->status =='draft' ? $sow->project_name : $sow->sow_code;
    $trail->push($identifier, route('revision',['filter'=>$filter,'id'=>$sow->id] ));
    $trail->push("transaction ", route('revision',['filter'=>$filter,'id'=>$sow->id] ));
});

//location master 
Breadcrumbs::for('locations.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Locations", route('locations.index'));
});

Breadcrumbs::for('locations.create', function ($trail ) {
    $trail->parent('locations.index');
    $trail->push("Create", route('locations.create'));
}); 

Breadcrumbs::for('locations.show', function ($trail, $location ) {
    $trail->parent('locations.index');
    $trail->push($location->type, route('locations.show', $location->id));
    $trail->push("Show", route('locations.show', $location->id));
});

Breadcrumbs::for('locations.edit', function ($trail, $location ) {
    $trail->parent('locations.index');
    $trail->push($location->type, route('locations.edit', $location->id));
    $trail->push("Edit", route('locations.edit', $location->id));
});

//roles master
Breadcrumbs::for('roles.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Role", route('roles.index'));
});
Breadcrumbs::for('roles.create', function ($trail ) {
    $trail->parent('roles.index');
    $trail->push("Create", route('roles.create'));
});
Breadcrumbs::for('roles.edit', function ($trail, $role ) {
    $trail->parent('roles.index');
    $trail->push($role->name,route('roles.edit',$role->id));
    $trail->push("Edit", route('roles.edit', $role->id));
});
Breadcrumbs::for('roles.show', function ($trail, $role ) {
    $trail->parent('roles.index');
    $trail->push($role->name,route('roles.show',$role->id));
    $trail->push("Show", route('roles.show', $role->id));
});

//Project skills Master
Breadcrumbs::for('projectskills.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Project Skill", route('projectskills.index'));
});
Breadcrumbs::for('projectskills.create', function ($trail ) {
    $trail->parent('projectskills.index');
    $trail->push("Create", route('projectskills.create'));
});
Breadcrumbs::for('projectskills.edit', function ($trail, $projectskill ) {
    $trail->parent('projectskills.index');
    $trail->push($projectskill->name,route('projectskills.edit',$projectskill->id));
    $trail->push("Edit", route('projectskills.edit', $projectskill->id));
});
Breadcrumbs::for('projectskills.show', function ($trail, $projectskill ) {
    $trail->parent('projectskills.index');
    $trail->push($projectskill->name,route('projectskills.show',$projectskill->id));
    $trail->push("Show", route('projectskills.show', $projectskill->id));
});


//Manager Master
Breadcrumbs::for('managers.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Manager", route('managers.index'));
});
Breadcrumbs::for('managers.create', function ($trail ) {
    $trail->parent('managers.index');
    $trail->push("Create", route('managers.index'));
});
Breadcrumbs::for('managers.edit', function ($trail, $manager ) {
    $trail->parent('managers.index');
    $trail->push($manager->name,route('managers.edit',$manager->id));
    $trail->push("Edit", route('managers.index', $manager->id));
});
Breadcrumbs::for('managers.show', function ($trail, $manager ) {
    $trail->parent('managers.index');
    $trail->push($manager->name,route('managers.show',$manager->id));
    $trail->push("Show", route('managers.index', $manager->id));
});

//Project Role Master
Breadcrumbs::for('projectroles.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Project Roles", route('projectroles.index'));
});
Breadcrumbs::for('projectroles.create', function ($trail ) {
    $trail->parent('projectroles.index');
    $trail->push("Create", route('projectroles.create'));
});
Breadcrumbs::for('projectroles.edit', function ($trail, $projectrole ) {
    $trail->parent('projectroles.index');
    $trail->push($projectrole->name,route('projectroles.edit',$projectrole->id));
    $trail->push("Edit", route('projectroles.edit', $projectrole->id));
});
Breadcrumbs::for('projectroles.show', function ($trail, $projectrole ) {
    $trail->parent('projectroles.index');
    $trail->push($projectrole->name,route('projectroles.show',$projectrole->id));
    $trail->push("Show", route('projectroles.show', $projectrole->id));
});

//Procuring Master
Breadcrumbs::for('procuring.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Procuring Party", route('procuring.index'));
});
Breadcrumbs::for('procuring.create', function ($trail ) {
    $trail->parent('procuring.index');
    $trail->push("Create", route('procuring.create'));
});
Breadcrumbs::for('procuring.edit', function ($trail, $procuringparty ) {
    $trail->parent('procuring.index');
    $trail->push($procuringparty->name,route('procuring.edit',$procuringparty->id));
    $trail->push("Edit", route('procuring.edit', $procuringparty->id));
});
Breadcrumbs::for('procuring.show', function ($trail, $procuringparty ) {
    $trail->parent('procuring.index');
    $trail->push($procuringparty->name,route('procuring.show',$procuringparty->id));
    $trail->push("Show", route('procuring.show', $procuringparty->id));
});

//Project Type Master
Breadcrumbs::for('project_type.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Project Types", route('project_type.index'));
});
Breadcrumbs::for('project_type.create', function ($trail ) {
    $trail->parent('project_type.index');
    $trail->push("Create", route('project_type.create'));
});
Breadcrumbs::for('project_type.edit', function ($trail, $project_type ) {
    $trail->parent('project_type.index');
    $trail->push($project_type->type,route('project_type.edit',$project_type->id));
    $trail->push("Edit", route('project_type.edit',$project_type->id));
});
Breadcrumbs::for('project_type.show', function ($trail, $project_type ) {
    $trail->parent('project_type.index');
    $trail->push($project_type->type,route('project_type.show',$project_type->id));
    $trail->push("Show", route('project_type.show',$project_type->id));
});

//sow header Master
Breadcrumbs::for('header_sow', function ($trail ) {
    $trail->parent('home');
    $trail->push("Sow Header");
});

Breadcrumbs::for('header_sow.edit', function ($trail,$ptype,$sow) {
    $trail->parent('home');
    $trail->push("Sow Header",route('sow_header'));
    $trail->push($ptype->type,route('sow_header_edit',$sow->id));
    $trail->push("Edit");

});
Breadcrumbs::for('header_sow.show', function ($trail,$ptype,$sow) {
    $trail->parent('home');
    $trail->push("Sow Header",route('sow_header'));
    $trail->push($ptype->type,route('sow_header_show',$sow->id));
    $trail->push("Show");

});

//Project Type Master
Breadcrumbs::for('permission.index', function ($trail ) {
    $trail->parent('home');
    $trail->push("Permission", route('permission.index'));
});
Breadcrumbs::for('permission.create', function ($trail ) {
    $trail->parent('permission.index');
    $trail->push("Create", route('permission.create'));
});
Breadcrumbs::for('permission.edit', function ($trail, $permission ) {
    $trail->parent('permission.index');
    $trail->push($permission->name, route('permission.edit',$permission->id));
    $trail->push("Edit", route('permission.edit',$permission->id));
});