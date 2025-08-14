import {createRouter, createWebHistory} from "vue-router";
import cookiesServices from "../apiController/cookiesServices.js";

import authLayout from "../authentication/layout/layout.vue";
    import login from "../authentication/pages/login.vue";
    import forgot from "../authentication/pages/forgot.vue";
    import reset from "../authentication/pages/reset.vue";

import portalLayout from "../portal/layout/layout.vue";
    import dashboard from "../portal/pages/dashboard.vue";
    import events from "../portal/pages/events.vue";
    import instructors from "../portal/pages/instructor/list.vue";
        import manageInstructor from "../portal/pages/instructor/manage.vue";
    import students from "../portal/pages/student/list.vue";
        import manageStudent from "../portal/pages/student/manage.vue";
    import courses from "../portal/pages/course/list.vue";
        import manageCourse from "../portal/pages/course/manage.vue";
    import libraries from "../portal/pages/library-assets/list.vue";
        import manageLibrary from "../portal/pages/library-assets/manage.vue";
    import departments from "../portal/pages/department/list.vue";
        import manageDepartment from "../portal/pages/department/manage.vue";
    import staffs from "../portal/pages/staff/list.vue";
        import manageStaff from "../portal/pages/staff/manage.vue";
    import holidays from "../portal/pages/holiday/list.vue";
        import manageHoliday from "../portal/pages/holiday/manage.vue";
    import fees from "../portal/pages/fees/list.vue";
        import manageFees from "../portal/pages/fees/manage.vue";
    import profile from "../portal/pages/profile.vue";

const title = 'LMS - ';
const routes = [
    { path: '/admin/auth', name: 'authLayout', component: authLayout,
        children: [
            { path: 'login', name: 'login', component: login, meta: {title: title + 'Login'}},
            { path: 'forgot', name: 'forgot', component: forgot, meta: {title: title + 'Forgot'}},
            { path: 'reset', name: 'reset', component: reset, meta: {title: title + 'Reset'}},
        ]
    },
    {
        path: '/admin', name: 'portalLayout', component: portalLayout,
        children: [
            { path: '', name: 'dashboard', component: dashboard, meta: {title: title + 'Dashboard'} },
            { path: 'events', name: 'events', component: events, meta: {title: title + 'Events'} },
            { path: 'instructors', name: 'instructors', component: instructors, meta: {title: title + 'Instructors'} },
                { path: 'manage-instructor', name: 'manageInstructor', component: manageInstructor, meta: {title: title + 'Manage Instructor'} },
            { path: 'students', name: 'students', component: students, meta: {title: title + 'Students'} },
                { path: 'manage-student', name: 'manageStudent', component: manageStudent, meta: {title: title + 'Manage Student'} },
            { path: 'courses', name: 'courses', component: courses, meta: {title: title + 'Courses'} },
                { path: 'manage-course', name: 'manageCourse', component: manageCourse, meta: {title: title + 'manage Course'} },
            { path: 'libraries', name: 'libraries', component: libraries, meta: {title: title + 'Libraries'} },
                { path: 'manage-library', name: 'manageLibrary', component: manageLibrary, meta: {title: title + 'manage Library'} },
            { path: 'departments', name: 'departments', component: departments, meta: {title: title + 'Departments'} },
                { path: 'manage-department', name: 'manageDepartment', component: manageDepartment, meta: {title: title + 'Manage Department'} },
            { path: 'staffs', name: 'staffs', component: staffs, meta: {title: title + 'Staffs'} },
                { path: 'manage-staff', name: 'manageStaff', component: manageStaff, meta: {title: title + 'Manage Staff'} },
            { path: 'holidays', name: 'holidays', component: holidays, meta: {title: title + 'Holidays'} },
                { path: 'manage-holiday', name: 'manageHoliday', component: manageHoliday, meta: {title: title + 'Manage Holiday'} },
            { path: 'fees', name: 'fees', component: fees, meta: {title: title + 'Fees'} },
                { path: 'manage-fees', name: 'manageFees', component: manageFees, meta: {title: title + 'Manage Fees'} },
            { path: 'profile', name: 'profile', component: profile, meta: {title: title + 'Profile'} },
        ]
    },
];

const router = createRouter({
    history: createWebHistory(), routes,
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            return {
                el: to.hash,
                behavior: 'smooth',
            };
        } else {
            return {top: 0, behavior: 'smooth'};
        }
    }
});
router.beforeEach((to, from, next) => {
    const isAuthenticated = !!cookiesServices.get('admin_token');
    if (to.matched.some(record => record.name === 'authLayout')) {
        if (isAuthenticated) {
            next({name: 'dashboard'});
        } else {
            next();
        }
    } else if (to.matched.some(record => record.name === 'portalLayout')) {
        if (!isAuthenticated) {
            next({name: 'login'});
        } else {
            next();
        }
    } else {
        next();
    }
});
export default router;
