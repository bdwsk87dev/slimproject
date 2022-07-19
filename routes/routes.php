<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

use App\Controllers\SiteMapController;
use App\Controllers\LangController;
use App\Controllers\UserController;
use App\Controllers\MainController;
use App\Controllers\LocationController;
use App\Controllers\ReviewController;
use App\Controllers\MediaFileController;
use App\Controllers\AuthController;

return function (App $app) {

    $app->group("/{lang:en|uk|ru}", function (RouteCollectorProxy $group) {

        /** main **/
        $group->get("", [MainController::class, "index"]);

        /** sitemap **/
        $group->get("/sitemap", [SiteMapController::class, "index"]);

        /** lang **/
        $group->group("/lang", function (RouteCollectorProxy $group) {
            $group->get("/{page}", [LangController::class, "getAll"]);
            $group->get("/{page}/{part}", [LangController::class, "getOne"]);
        });

        /** locations **/
        $group->group("/locations", function (RouteCollectorProxy $group) {
            $group->get("", [LocationController::class, "getAll"]);
            $group->get("/{id:[\d]+}", [LocationController::class, "getOne"]);
            $group->get("/{id:[\d]+}/edit", [LocationController::class, "getOneForUpdate"]);
            $group->get("/{id:[\d]+}/reviews", [ReviewController::class, "getAllByLocationId"]);
            $group->get("/{id:[\d]+}/media-files", [MediaFileController::class, "getAllByLocationId"]);
            $group->get("/filters", [LocationController::class, "getFilters"]);

            $group->post("", [LocationController::class, "create"]);
            $group->put("/{id:[\d]+}", [LocationController::class, "update"]);
            $group->delete("/{id:[\d]+}", [LocationController::class, "delete"]);
        });

        /** reviews **/
        $group->group("/reviews", function (RouteCollectorProxy $group) {
            $group->get("", [ReviewController::class, "getAll"]);
            $group->get("/filters", [ReviewController::class, "getFilters"]);
            $group->get("/{id:[\w-]+}", [ReviewController::class, "getOne"]);

            $group->post("/{id:[\w-]+}", [ReviewController::class, "update"]);
            $group->delete("/{id:[\w-]+}", [ReviewController::class, "delete"]);
        });

        /** media-files **/
        $group->group("/media-files", function (RouteCollectorProxy $group) {
            $group->get("", [MediaFileController::class, "getAll"]);
            $group->get("/{id:[\w-]+}", [MediaFileController::class, "getOne"]);

            $group->post("", [MediaFileController::class, "create"]);
            $group->put("/{id:[\w-]+}", [MediaFileController::class, "update"]);
            $group->delete("/{id:[\w-]+}", [MediaFileController::class, "delete"]);
        });

        /** users **/
        $group->group("/auth", function (RouteCollectorProxy $group) {
            $group->post("/login", [AuthController::class, "login"]);
            $group->get("/logout", [AuthController::class, "logout"]);
            $group->get("/user/get",[UserController::class, "getUser"]);
            $group->post("/register",[AuthController::class, "register"]);
        });

    });

};
