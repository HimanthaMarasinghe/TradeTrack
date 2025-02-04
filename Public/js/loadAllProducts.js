/**
 * This script can be used to load all the products in the database by any user.
 * Just include the nesesary elemnts with required IDs 
 * and define nesesary constants (`clickLink` is special for this scrip) 
 * inside a `<sript>` tag in php code.
 */

import ApiFetcherMod from "./ApiFetcherMod.js";
import { productCard } from "./UI_Elements_templates.js";

const apiFetcherConfig = {
    api: "/LogedInUserCommon/getProducts",
    cardTemplate: productCard,
};

new ApiFetcherMod(apiFetcherConfig);