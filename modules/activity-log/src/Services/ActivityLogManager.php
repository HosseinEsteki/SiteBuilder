<?php

namespace ActivityLog\Services;

use ActivityLog\Models\ActivityLog as ActivityLogModel;

class ActivityLogManager
{
    public function log($data)
    {
        return ActivityLogModel::create($data);
    }

    public function all($filters = [])
    {
        return ActivityLogModel::query()
            ->when(isset($filters['user_id']), fn ($q) => $q->where('user_id', $filters['user_id']))
            ->when(isset($filters['model']), fn ($q) => $q->where('model', $filters['model']))
            ->when(isset($filters['model_id']), fn ($q) => $q->where('model_id', $filters['model_id']))
            ->when(isset($filters['action']), fn ($q) => $q->where('action', $filters['action']))
            ->when(isset($filters['ip_address']), fn ($q) => $q->where('ip_address', $filters['ip_address']))
            ->when(isset($filters['date_from']), fn ($q) => $q->whereDate('created_at', '>=', $filters['date_from']))
            ->when(isset($filters['date_to']), fn ($q) => $q->whereDate('created_at', '<=', $filters['date_to']))
            ->orderBy('created_at', 'desc')
            ->limit((int) ($filters['limit'] ?? 100))
            ->get();
    }

    public function search(string $keyword, $filters = [])
    {
        return ActivityLogModel::query()
            ->where(function ($q) use ($keyword) {
                $q->where('model', 'like', "%{$keyword}%")
                    ->orWhere('action', 'like', "%{$keyword}%")
                    ->orWhere('user_agent', 'like', "%{$keyword}%")
                    ->orWhereJsonContains('changes->after', $keyword);
            })
            ->when(isset($filters['user_id']), fn ($q) => $q->where('user_id', $filters['user_id']))
            ->when(isset($filters['model']), fn ($q) => $q->where('model', $filters['model']))
            ->when(isset($filters['model_id']), fn ($q) => $q->where('model_id', $filters['model_id']))
            ->when(isset($filters['action']), fn ($q) => $q->where('action', $filters['action']))
            ->orderBy('created_at', 'desc')
            ->limit((int) ($filters['limit'] ?? 100))
            ->get();
    }

    public function stats(): array
    {
        return [
            'total' => ActivityLogModel::count(),
            'by_action' => ActivityLogModel::query()
                ->selectRaw('action, COUNT(*) as total')
                ->groupBy('action')
                ->pluck('total', 'action')
                ->toArray(),
            'by_model' => ActivityLogModel::query()
                ->selectRaw('model, COUNT(*) as total')
                ->groupBy('model')
                ->pluck('total', 'model')
                ->toArray(),
            'latest' => ActivityLogModel::query()
                ->latest()
                ->limit(5)
                ->get(['id', 'model', 'action', 'model_id', 'created_at'])
                ->toArray(),
        ];
    }
}
