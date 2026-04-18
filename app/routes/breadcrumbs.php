<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Models
use App\Models\ChatRoom;
use App\Models\Post;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(Lang::get('routes.web.home'), route('home'));
});

// Home > Posts (Guest)
Breadcrumbs::for('public.posts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.public.posts.index'), route('public.posts.index'));
});

// Home > Posts (Guest) > Show
Breadcrumbs::for('public.posts.show', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('public.posts.index');
    $trail->push($post->title, route('public.posts.show', $post));
});

// Home > 5bukv
Breadcrumbs::for('5bukv', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.5bukv'), route('5bukv'));
});

// Home > Hash
Breadcrumbs::for('hash', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.hash'), route('hash'));
});

// Home > Chat
Breadcrumbs::for('chat.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.chat.index'), route('chat.index'));
});

// Home > Chat > Show
Breadcrumbs::for('chat.rooms.show', function (BreadcrumbTrail $trail, ChatRoom $chatRoom) {
    $trail->parent('chat.index');
    $trail->push($chatRoom->name, route('chat.rooms.show', $chatRoom));
});

// Home > Memos
Breadcrumbs::for('memos.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.memos.index'), route('memos.index'));
});

// Home > Posts
Breadcrumbs::for('posts.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.posts.index'), route('posts.index'));
});

// Home > Posts > Create
Breadcrumbs::for('posts.create', function (BreadcrumbTrail $trail) {
    $trail->parent('posts.index');
    $trail->push(Lang::get('routes.web.posts.create'), route('posts.create'));
});

// Home > Posts > Show
Breadcrumbs::for('posts.show', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('posts.index');
    $trail->push($post->title, route('posts.show', $post));
});

// Home > Posts > Edit
Breadcrumbs::for('posts.edit', function (BreadcrumbTrail $trail, Post $post) {
    $trail->parent('posts.show', $post);
    $trail->push(Lang::get('routes.web.posts.edit'), route('posts.edit', $post));
});

// Home > Uploads
Breadcrumbs::for('uploads.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.uploads.index'), route('uploads.index'));
});

// Home > Users
// Breadcrumbs::for('users.index', function (BreadcrumbTrail $trail) {
//     $trail->parent('home');
//     $trail->push(Lang::get('routes.web.users.index'), route('users.index'));
// });

// Home > Users > Show
Breadcrumbs::for('users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('home');
    $trail->push($user->name, route('users.show', $user));
});

// Home > Admin
Breadcrumbs::for('admin', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(Lang::get('routes.web.admin.index'));
});

// Home > Admin > Roles
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(Lang::get('routes.web.admin.roles.index'), route('admin.roles.index'));
});

// Home > Admin > Roles > Create
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push(Lang::get('routes.web.admin.roles.create'), route('admin.roles.create'));
});

// Home > Admin > Roles > Edit
Breadcrumbs::for('admin.roles.edit', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('admin.roles.index');
    $trail->push($role->name);
    $trail->push(Lang::get('routes.web.admin.roles.edit'), route('admin.roles.edit', $role));
});

// Home > Admin > Permissiona > Create
Breadcrumbs::for('admin.permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push(Lang::get('routes.web.admin.permissions.create'), route('admin.permissions.create'));
});

// Home > Admin > Permissiona > Edit
Breadcrumbs::for('admin.permissions.edit', function (BreadcrumbTrail $trail, Permission $permission) {
    $trail->parent('admin.roles.index');
    $trail->push(Lang::get('routes.web.admin.permissions.index'));
    $trail->push($permission->name);
    $trail->push(Lang::get('routes.web.admin.permissions.edit'), route('admin.permissions.edit', $permission));
});

// Home > Admin > Users
Breadcrumbs::for('admin.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin');
    $trail->push(Lang::get('routes.web.admin.users.index'), route('admin.users.index'));
});

// Home > Admin > Users > Create
Breadcrumbs::for('admin.users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.users.index');
    $trail->push(Lang::get('routes.web.admin.users.create'), route('admin.users.create'));
});

// Home > Admin > Users > Show
Breadcrumbs::for('admin.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.index');
    $trail->push($user->name, route('admin.users.show', $user));
});

// Home > Admin > Users > Edit
Breadcrumbs::for('admin.users.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('admin.users.show', $user);
    $trail->push(Lang::get('routes.web.admin.users.edit'), route('admin.users.edit', $user));
});