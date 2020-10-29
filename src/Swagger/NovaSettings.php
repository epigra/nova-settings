<?php

/**
 * @OA\Get(
 *     path="/settings",
 *     tags={"Settings"},
 *     summary="Returns all setting",
 *     description="Returns aall setting in project",
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent()
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/settings/{key}",
 *     tags={"Settings"},
 *     summary="Returns a setting by key",
 *     description="Returns a setting by key in project",
 *     @OA\Parameter(
 *          name="key",
 *          description="Key",
 *          required=true,
 *          in="path",
 *          @OA\Schema(
 *              type="string"
 *          )
 *      ),
 *     @OA\Response(
 *         response=200,
 *         description="successful operation",
 *         @OA\JsonContent()
 *     )
 * )
 */

