import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/react'
import { createRoot } from 'react-dom/client'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import GeneralLayout from './Layouts/GeneralLayout';
import AuthenticatedLayout from './Layouts/AuthenticatedLayout';
import AdminLayout from './Layouts/AdminLayout';
import GuestLayout from './Layouts/GuestLayout';


createInertiaApp({
  resolve: (name) =>
    resolvePageComponent(
        `./Pages/${name}.jsx`,
        import.meta.glob('./Pages/**/*.jsx'),
    ).then((module) => {
        const page = module.default;
        // Extract the subdirectory from the component name
        const subdirectory = name.split('/')[0]; // e.g., 'General' or 'User'

        switch (subdirectory) {
            case 'User':           
                page.layout = (page) => <AuthenticatedLayout>{page}</AuthenticatedLayout>
                break;
            case 'Admin':
                page.layout = (page) => <AdminLayout>{page}</AdminLayout>
                break;
            case 'Auth':
                page.layout = (page) => <GuestLayout>{page}</GuestLayout>
                break;                
            case 'General':
            default:
                page.layout = (page) => <GeneralLayout>{page}</GeneralLayout>
                break;

        }
        
        return page;
    }),
  setup({ el, App, props }) {
    createRoot(el).render(<App {...props} />)
  },
})