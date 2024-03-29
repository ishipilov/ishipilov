<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Models
use App\Models\Article;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Guestbook
Breadcrumbs::for('guestbook.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Guestbook', route('guestbook.index'));
});

// Home > Guestbook > Create
Breadcrumbs::for('guestbook.create', function (BreadcrumbTrail $trail) {
    $trail->parent('guestbook.index');
    $trail->push('Create', route('guestbook.create'));
});

// Home > Articles
Breadcrumbs::for('articles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Articles', route('articles.index'));
});

// Home > Articles > User
Breadcrumbs::for('articles.user', function (BreadcrumbTrail $trail) {
    $trail->parent('articles.index');
    $trail->push('My articles', route('articles.user'));
});

// Home > Articles > User > Create
Breadcrumbs::for('articles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('articles.user');
    $trail->push('Create', route('articles.create'));
});

// Home > Articles > Show
Breadcrumbs::for('articles.show', function (BreadcrumbTrail $trail, Article $article) {
    if ($article->isPublished) {
        $trail->parent('articles.index');
    } else {
        $trail->parent('articles.user');
    }
    $trail->push($article->titleSub, route('articles.show', $article));
});

// Home > Articles > Edit
Breadcrumbs::for('articles.edit', function (BreadcrumbTrail $trail, Article $article) {
    $trail->parent('articles.show', $article);
    $trail->push('Edit', route('articles.edit', $article));
});

// Home > Invitations
Breadcrumbs::for('invitations.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('My invitations', route('invitations.index'));
});

// Home > Invitations > Create
Breadcrumbs::for('invitations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('invitations.index');
    $trail->push('Create', route('invitations.create'));
});