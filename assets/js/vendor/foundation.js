import $ from "jquery"

import { Foundation } from "foundation-sites/js/foundation.core"
Foundation.addToJquery($)

import { Keyboard } from "foundation-sites/js/foundation.util.keyboard"
Foundation.Keyboard = Keyboard

import { Touch } from "foundation-sites/js/foundation.util.touch"
Touch.init($)

import { Triggers } from "foundation-sites/js/foundation.util.triggers"
Triggers.init($, Foundation)

import { AccordionMenu } from "foundation-sites/js/foundation.accordionMenu"
Foundation.plugin(AccordionMenu, "AccordionMenu")

import { DropdownMenu } from "foundation-sites/js/foundation.dropdownMenu"
Foundation.plugin(DropdownMenu, "DropdownMenu")

import { OffCanvas } from "foundation-sites/js/foundation.offcanvas"
Foundation.plugin(OffCanvas, "OffCanvas")

import { ResponsiveMenu } from "foundation-sites/js/foundation.responsiveMenu"
Foundation.plugin(ResponsiveMenu, "ResponsiveMenu")
