const apiVersion = "/api/admin/";

const apiRoute = {

    admin: {
        login: apiVersion + 'login',
        registration: apiVersion + 'registration',
        forgot: apiVersion + 'forgot',
        reset: apiVersion + 'reset',

        event: apiVersion + 'event',
        tutor: apiVersion + 'tutor',
        student: apiVersion + 'student',
        course: apiVersion + 'course',
        libraryAssets: apiVersion + 'library-assets',
        department: apiVersion + 'department',
        staff: apiVersion + 'staff',
        holiday: apiVersion + 'holiday',
        fees: apiVersion + 'fees',

        general: apiVersion + 'general',

        details: apiVersion + 'profile/details',
        changeDetails: apiVersion + 'profile/change-details',
        changePassword: apiVersion + 'profile/change-password',
        logout: apiVersion + 'profile/logout',
    }

}

export default apiRoute;
