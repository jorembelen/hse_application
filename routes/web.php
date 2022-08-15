<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvestigationPrintController;
use App\Http\Livewire\Admin\CreateIncidentNotifications;
use App\Http\Livewire\Admin\CreateInvestigationReport;
use App\Http\Livewire\Admin\EmployeesComponent;
use App\Http\Livewire\Admin\LocationsComponent;
use App\Http\Livewire\Admin\UsersComponent;
use App\Http\Livewire\Admin\UserSessionsList;
use App\Http\Livewire\Incident\IncidentNotifications;
use App\Http\Livewire\Incident\IncidentDetails;
use App\Http\Livewire\Incident\IncidentEdit;
use App\Http\Livewire\Incident\PendingIncidents;
use App\Http\Livewire\Investigation\InvestigationDetails;
use App\Http\Livewire\Investigation\InvestigationEdit;
use App\Http\Livewire\Investigation\InvestigationsList;
use App\Http\Livewire\Investigation\Reviews;
use App\Http\Livewire\Manager\Incidents;
use App\Http\Livewire\Manager\Investigations;
use App\Http\Livewire\Manager\InvestigationsComment;
use App\Http\Livewire\Project\PendingIncidents as ProjectPendingIncidents;
use App\Http\Livewire\Project\PendingRecommendations as ProjectPendingRecommendations;
use App\Http\Livewire\Project\ProjectIncidents;
use App\Http\Livewire\Project\ProjectInvestigations;
use App\Http\Livewire\Project\ProjectRecommendations;
use App\Http\Livewire\Recommendation\PendingRecommendations;
use App\Http\Livewire\Recommendation\RecommendationsList;
use App\Http\Livewire\Recommendation\ReportsRecommendation;
use App\Http\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('incident/{incident}/details', [InvestigationPrintController::class, 'printIncident'])->name('print.incident');
Route::get('investigation/{report}/details', [InvestigationPrintController::class, 'printReporDetails'])->name('print.report-details');

Route::group(['middleware' => ['auth']], function() {

    // For project
    Route::get('/project-incident-investigation', ProjectInvestigations::class)->name('project.investigation');
    Route::get('/project-incident-notifications', ProjectIncidents::class)->name('project.incidents');
    Route::get('/project-pending-incident-notifications', ProjectPendingIncidents::class)->name('project.pending-incidents');
    Route::get('/project-recommendations', ProjectRecommendations::class)->name('project.recommendations');
    Route::get('/project-pending-recommendations', ProjectPendingRecommendations::class)->name('project.pending-recommendations');

    Route::get('user-profile', UserProfile::class)->name('profile');

    Route::get('incidents-list', Incidents::class)->name('incidents');
    Route::get('investigations-list', Investigations::class)->name('investigations');
    Route::get('investigations/{reportId}/comment', InvestigationsComment::class)->name('investigations.comment');

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('print/{incident}', [HomeController::class, 'print'])->name('print');
    Route::get('print/{report}/investigation-report', [HomeController::class, 'printReport'])->name('print.report');

    Route::get('/reviews', Reviews::class)->name('reviews');
    Route::get('/recommendations', RecommendationsList::class)->name('admin.recommendation');
    Route::get('/pending-recommendations', PendingRecommendations::class)->name('admin.pending-recommendation');
    Route::get('/report/{reportId}/recommendations', ReportsRecommendation::class)->name('report.recommendation');


    Route::get('/incident-investigation/{reportId}/details', InvestigationDetails::class)->name('investigation.info');
    Route::get('/incident-investigation/{investigation}/edit', InvestigationEdit::class)->name('investigation.edit');
    Route::get('/incident-notification/{incidentId}/details', IncidentDetails::class)->name('incident.info');
    Route::get('/pending-incident-notifications', PendingIncidents::class)->name('admin.pending-incidents');
    Route::get('/create-notification', CreateIncidentNotifications::class)->name('admin.create-notifications');
    Route::get('/create/{incidentId}/investigation', CreateInvestigationReport::class)->name('admin.create-investigation');


    Route::get('edit/{incident}/incident-notification', IncidentEdit::class)->name('edit.incident');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('admin-locations', LocationsComponent::class)->name('admin.locations');
        Route::get('admin-employees', EmployeesComponent::class)->name('admin.employees');
        Route::get('admin-users', UsersComponent::class)->name('admin.users');
        Route::get('admin-users-session', UserSessionsList::class)->name('admin.users-session');
        Route::get('/admin-incident-investigation', InvestigationsList::class)->name('admin.investigation');
        Route::get('/admin-incident-notifications', IncidentNotifications::class)->name('admin.incidents');

    });

});
