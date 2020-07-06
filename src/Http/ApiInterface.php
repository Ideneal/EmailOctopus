<?php
/*
 * This file is part of the ideneal/emailoctopus library
 *
 * (c) Daniele Pedone <ideneal.ztl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Ideneal\EmailOctopus\Http;


use Psr\Http\Message\ResponseInterface;

/**
 * Interface ApiInterface
 *
 * @package Ideneal\EmailOctopus\Http
 */
interface ApiInterface
{
    /**
     * @param string $path
     * @param array  $params
     *
     * @return ResponseInterface
     */
    public function get(string $path, array $params = []): ResponseInterface;

    /**
     * @param string $path
     * @param array  $data
     * @param array  $params
     *
     * @return ResponseInterface
     */
    public function post(string $path, array $data = [], array $params = []): ResponseInterface;

    /**
     * @param string $path
     * @param array  $data
     * @param array  $params
     *
     * @return ResponseInterface
     */
    public function put(string $path, array $data = [], array $params = []): ResponseInterface;

    /**
     * @param string $path
     * @param array  $params
     *
     * @return ResponseInterface
     */
    public function delete(string $path, array $params = []): ResponseInterface;
}