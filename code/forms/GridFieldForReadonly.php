<?php

/**
 * GridField with a proper ReadOnly version ...
 *
 * FROM: https://github.com/silverstripe/silverstripe-framework/issues/3357#issuecomment-64543948
 */
class GridFieldForReadonly extends GridField {


    /**
     * Returns a readonly version of this field
     * @return GridField
     */
    public function performReadonlyTransformation() {
        $this->getConfig()
            ->removeComponentsByType("GridFieldDeleteAction")
            ->removeComponentsByType("GridFieldAddExistingAutocompleter")
            ->removeComponentsByType("GridFieldAddNewButton")
            ->removeComponentsByType('GridFieldManyRelationHandler');
        return $this;
    }

}