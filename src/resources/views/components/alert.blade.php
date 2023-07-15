<div {{
    $attributes
        ->class([
            'alert',
            'alert-danger' => $type->isDanger(),
            'alert-info' => $type->isInfo(),
            'alert-warning' => $type->isWarning(),
            'alert-success' => $type->isSuccess(),
        ])
}}>
    {{ $message ?? $slot }}
</div>
