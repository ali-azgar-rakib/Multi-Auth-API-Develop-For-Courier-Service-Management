// Admin component
import AdminDashboard from "./components/admin/AdminDashboard";
import AddSlider from "./components/admin/AddSlider";
import AllSlider from "./components/admin/AllSlider";
import AddService from "./components/admin/AddService";
import AllService from "./components/admin/AllService";
import Zone from "./components/admin/Zone";
import Size from "./components/admin/Size";
import Bank from "./components/admin/Bank";
import ShopCategory from "./components/admin/ShopCategory";
import ContactDetails from "./components/admin/ContactDetails";
import SetOpenTime from "./components/admin/SetOpenTime";
export default [
    {
        path: "/admin/home",
        component: AdminDashboard,
        meta: { transition: "overlay-left-right" }
    },
    {
        path: "/admin/add/slider",
        component: AddSlider
    },
    {
        path: "/admin/all/slider",
        component: AllSlider
    },
    {
        path: "/admin/add/service",
        component: AddService
    },
    {
        path: "/admin/all/service",
        component: AllService
    },
    {
        path: "/admin/zone",
        component: Zone
    },
    {
        path: "/admin/size",
        component: Size
    },
    {
        path: "/admin/bank",
        component: Bank
    },
    {
        path: "/admin/shop-category",
        component: ShopCategory
    },
    {
        path: "/admin/contact-details",
        component: ContactDetails
    },
    {
        path: "/admin/set-open-time",
        component: SetOpenTime
    }
];
