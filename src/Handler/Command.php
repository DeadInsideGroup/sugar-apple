<?php

namespace Handler;

use Handler\CMD\CMDHandler;

/**
 * @author Ammar Faizi <ammarfaizi2@gmail.com>
 * @license MIT
 */

trait Command
{
    private function command()
    {
        $cmd_list = [
            "/sh"            => ["!sh", "~sh", "/shexec", "!shexec", "~shexec", "shexec"],
            "/me"            => ["!me", "~me"],
            "/help"          => ["!help", "~help"],
            "/ban"            => ["!ban", "~ban", "/banned", "!banned", "~banned"],
            "/debug"        => ["!debug", "/debug", "/d", "!d"],
            "/start"        => ["!start", "~start"],
            "/anime"        => ["!anime", "~anime"],
            "/manga"        => ["!manga", "~manga"],
            "/idan"            => ["!idan", "~idan"],
            "/idma"            => ["!idma", "~idma"],
            "/warn"            => ["!warn", "~warn"],
            "/report"          => ["!report", "~report"],
            "/forgive"         => ["!forgive", "~forgive"],
            "/welcome"        => ["!welcome", "~welcome"]
        ];
        $fs = explode(" ", $this->h->text, 2) xor $param = isset($fs[1]) ? trim($fs[1]) : null;
        $fs = explode("@", $fs[0]);
        $fs = strtolower($fs[0]);
        foreach ($cmd_list as $key => $val) {
            if ($fs == $key) {
                return $this->__command($key, $param);
            } else {
                foreach ($val as $val) {
                    if ($fs == $val) {
                        return $this->__command($key, $param);
                    }
                }
            }
        }
        return false;
    }

    private function __command($key, $param = null)
    {
        $cmd = new CMDHandler($this->h);
        switch ($key) {
            case '/help':
                return $cmd->__help($param);
                break;
            case '/debug':
                return $cmd->__debug($param);
                break;
            case '/start':
                return $cmd->__start($param);
                break;
            case '/sh':
                return $cmd->__sh($param);
                break;
            case '/ban':
                return $cmd->__ban($param);
                break;
            case '/anime':
                return $cmd->__anime($param);
                break;
            case '/manga':
                return $cmd->__manga($param);
                break;
            case '/idan':
                return $cmd->__idan($param);
                break;
            case '/idma':
                return $cmd->__idma($param);
                break;
            case '/warn':
                return $cmd->__warn($param);
                break;
            case '/report':
                return $cmd->__report($param);
                break;
            case '/welcome':
                return $cmd->__welcome($param);
                break;
            case '/forgive':
                return $cmd->__forgive($param);
                break;
            default:
                break;
        }
    }
}
