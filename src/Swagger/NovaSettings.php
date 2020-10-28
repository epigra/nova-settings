<?php

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

