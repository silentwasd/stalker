<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('truncate:messages')->hourly();
