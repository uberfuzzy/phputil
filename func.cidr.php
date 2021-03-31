<?php
/******************************************************************************
    Copyright 2008-2014 Christopher L. Stafford (uberfuzzy)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 ******************************************************************************/

/*
this function preforms CIDR range matching on IPv4 dotted quads

originally written by users on stackoverflow.com, slightly tweaked.
http://stackoverflow.com/questions/594112

use examples:
var_dump( cidr_match('127.1.2.3', '127.0.0.0/8') ); // match first left quad
var_dump( cidr_match('127.1.2.3', '127.0.0.0/16') ); // match left 2
var_dump( cidr_match('127.1.2.3', '127.0.0.0/24') ); // match left 3
var_dump( cidr_match('127.1.2.3', '127.0.0.0/32') ); // match all 4?
*/

function cidr_match($ip, $range)
{
    list ($subnet, $bits) = split('/', $range);
    $ip = ip2long($ip);
    $subnet = ip2long($subnet);
    $mask = -1 << (32 - $bits);
    $subnet &= $mask; # nb: in case the supplied subnet wasn't correctly aligned
    return ($ip & $mask) == $subnet;
}
