<?php

declare(strict_types=1);

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

if (!function_exists("env")) {
    function env($key, $default = false): string
    {
        $value = getenv($key);

        throw_when(!$value && !$default, "$key is not a defined .env variable and has not default value");

        return $value ?: $default;
    }
}

if (!function_exists("throw_when")) {
    function throw_when(bool $fails, string $message, string $exception = Exception::class)
    {
        if (!$fails) return;

        throw new $exception($message);
    }
}

if (!function_exists("base_path")) {
    function base_path(string $path = ""): string
    {
        return  __DIR__ . "/../$path";
    }
}

if (!function_exists("src_path")) {
    function src_path(string $path = ""): string
    {
        return base_path("src/$path");
    }
}

if (!function_exists("env_path")) {
    function env_path(string $path = ""): string
    {
        return base_path("$path");
    }
}

if (!function_exists("vendor_path")) {
    function vendor_path(string $path = ""): string
    {
        return base_path("vendor/$path");
    }
}

if (!function_exists("database_path")) {
    function database_path(string $path = ""): string
    {
        return base_path("database/$path");
    }
}

if (!function_exists("config_path")) {
    function config_path(string $path = ""): string
    {
        return base_path("config/$path");
    }
}

if (!function_exists("lang_path")) {
    function lang_path(array $pathInfo, string $ext): string
    {
        $path = implode("/", $pathInfo);
        return base_path("lang/$path.$ext");
    }
}

if (!function_exists("storage_path")) {
    function storage_path(string $path = ""): string
    {
        return base_path("storage/$path");
    }
}

if (!function_exists("public_path")) {
    function public_path(string $path = ""): string
    {
        return base_path("public/$path");
    }
}

if (!function_exists("resources_path")) {
    function resources_path(string $path = ""): string
    {
        return base_path("resources/$path");
    }
}

if (!function_exists("routes_path")) {
    function routes_path(string $path = ""): string
    {
        return base_path("routes/$path");
    }
}

if (!function_exists("app_path")) {
    function app_path(string $path = ""): string
    {
        return base_path("app/$path");
    }
}

if (!function_exists("log_path")) {
    function log_path(string $path = ""): string
    {
        return base_path("logs/$path");
    }
}

if (!function_exists("collect")) {
    function collect($items): Collection
    {
        return new Collection($items);
    }
}

if (!function_exists("dd")) {
    function dd(): void
    {
        array_map(function ($content) {
            echo "<pre>";
            var_dump($content);
            echo "</pre>";
            echo "<hr>";
        }, func_get_args());

        die;
    }
}

if (!function_exists("class_basename")) {
    function class_basename($class): string
    {
        $class = is_object($class) ? get_class($class) : $class;

        return basename(str_replace("\\", "/", $class));
    }
}

if (!function_exists("config")) {
    function config(string $path)
    {
        if (app()->getContainer()->has("config")) {
            $config = app()->getContainer()->get("config");

            if (!empty($config) && $data = data_get($config, $path)) {
                return $data;
            }
        }

        $path_info = explode(".", $path);
        $config_path = config_path("$path_info[0].php");

        throw_when(!file_exists($config_path), "$config_path doesn't exists!");

        data_set($config, $path_info[0], require_once $config_path);

        app()->getContainer()->set("config", $config);

        return data_get($config, $path);
    }
}

if (!function_exists("lang")) {
    function lang(string $path)
    {
        if (app()->getContainer()->has("lang")) {
            $lang = app()->getContainer()->get("lang");

            if (!empty($lang) && $data = data_get($lang, $path)) {
                return $data;
            }
        }

        $path_info = explode(".", $path);
        $lang_path = lang_path($path_info, "php");

        throw_when(!file_exists($lang_path), "$lang_path doesn't exists!");

        data_set($lang, $path_info, require_once $lang_path);

        app()->getContainer()->set("lang", $lang);

        return data_get($lang, $path);
    }
}

if (!function_exists("data_get")) {
    /**
     * Get an item from an array or object using "dot" notation.
     *
     * @param mixed $target
     * @param mixed $key
     * @param mixed $default
     *
     * @return mixed
     */
    function data_get(mixed $target, mixed $key, mixed $default = null): mixed
    {
        if (is_null($key)) {
            return $target;
        }

        $key = is_array($key) ? $key : explode(".", $key);

        foreach ($key as $i => $segment) {
            if ($segment === "*") {
                if ($target instanceof Collection) {
                    $target = $target->all();
                } elseif (!is_array($target)) {
                    return value($default);
                }

                $result = [];

                foreach ($target as $item) {
                    $result[] = data_get($item, $key);
                }

                return in_array("*", $key) ? Arr::collapse($result) : $result;
            }

            if (Arr::accessible($target) && Arr::exists($target, $segment)) {
                $target = $target[$segment];
            } elseif (is_object($target) && isset($target->{$segment})) {
                $target = $target->{$segment};
            } else {
                return value($default);
            }
        }

        return $target;
    }
}

if (!function_exists("data_set")) {
    /**
     * Set an item on an array or object using dot notation.
     *
     * @param mixed        $target
     * @param array|string $key
     * @param mixed        $value
     * @param bool         $overwrite
     *
     * @return mixed
     */
    function data_set(mixed &$target, array|string $key, mixed $value, bool $overwrite = true): mixed
    {
        $segments = is_array($key) ? $key : explode(".", $key);

        if (($segment = array_shift($segments)) === "*") {
            if (!Arr::accessible($target)) {
                $target = [];
            }

            if ($segments) {
                foreach ($target as &$inner) {
                    data_set($inner, $segments, $value, $overwrite);
                }
            } elseif ($overwrite) {
                foreach ($target as &$inner) {
                    $inner = $value;
                }
            }
        } elseif (Arr::accessible($target)) {
            if ($segments) {
                if (!Arr::exists($target, $segment)) {
                    $target[$segment] = [];
                }

                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite || ! Arr::exists($target, $segment)) {
                $target[$segment] = $value;
            }
        } elseif (is_object($target)) {
            if ($segments) {
                if (!isset($target->{$segment})) {
                    $target->{$segment} = [];
                }

                data_set($target->{$segment}, $segments, $value, $overwrite);
            } elseif ($overwrite || ! isset($target->{$segment})) {
                $target->{$segment} = $value;
            }
        } else {
            $target = [];

            if ($segments) {
                data_set($target[$segment], $segments, $value, $overwrite);
            } elseif ($overwrite) {
                $target[$segment] = $value;
            }
        }

        return $target;
    }
}

if (! function_exists("data_fill")) {
    /**
     * Fill in data where it's missing.
     *
     * @param mixed       $target
     * @param array|string $key
     * @param mixed       $value
     *
     * @return mixed
     */
    function data_fill(mixed &$target, array|string $key, mixed $value): mixed
    {
        return data_set($target, $key, $value, false);
    }
}
