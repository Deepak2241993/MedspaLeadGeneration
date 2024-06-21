@include('import.process-form', [
    'headingTitle' => __('app.importExcel') . ' ' . __('app.menu.lead'),
    'processRoute' => route('leads.import.process'),
    'backRoute' => route('leads.index'),
    'backButtonText' => __('app.backToLead'),
])
