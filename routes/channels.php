<?php

/*
 * What php team is that is 'one thing, a team, work together'
 */

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
