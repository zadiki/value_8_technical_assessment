<?php

namespace App\Interfaces;

interface BranchServiceInterface
{
    public function createBranch($storeId, $branchData);

    public function getBranchDetails($branchId);

    public function updateBranch($branchId, $branchData);

    public function deleteBranch($branchId);
}
