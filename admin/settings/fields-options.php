<?php if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="lightbox" id="field-number">

    <div class="lightbox-content p-4">
        <a href="#" class="lightbox-close"><span class="dashicons dashicons-no-alt"></span> </a>

        <div class="lightbox-title">Add Field</div>
        <form action="" id="form-params" data-field-index="">
            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Field type</label>
                        <div class="control">
                            <div class="select is-link">
                                <select name="type">
                                    <option value="1">Number</option>
                                    <option value="2">Select</option>
                                    <option value="3">Radio</option>
                                    <option value="4">Checkbox</option>
                                    <option value="5">Number + Select</option>
                                    <option value="6">Buttons</option>
                                    <option value="7">Result</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column">
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="control">
                            <input class="input is-link" name="title" type="text" placeholder="Enter title" autocomplete="off" value="Label">
                        </div>
                    </div>
                </div>
                <div class="column type-number">
                    <div class="field">
                        <label class="label">Addon</label>
                        <div class="field has-addons">

                            <div class="control is-expanded">
                                <input class="input is-link" name="addon" type="text" placeholder="Enter addon" autocomplete="off">
                            </div>
                            <div class="control">
                                <div class="select is-link">
                                    <select name="addon_pos">
                                        <option>right</option>
                                        <option>left</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-number">
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link">value</span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="value" type="text"
                                   placeholder="Enter value or left empty" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link">step</span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="step" type="text" placeholder="Enter step or left empty"
                                   value="0.01" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-number">
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link">min</span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" name="min" type="text" placeholder="Enter min or left empty" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field has-addons">
                        <div class="control">
                            <span class="button is-size-6 is-link">max</span>
                        </div>
                        <div class="control is-expanded">
                            <input class="input is-link" type="text" name="max" placeholder="Enter max or left empty" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-textarea is-hidden">
                <div class="column">
                    <div class="field">
                        <label class="label">Options</label>
                        <div class="control">
                            <textarea class="textarea is-link" name="options" placeholder="name = value"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns type-buttons is-hidden">
                <div class="column">
                    <div class="field">
                        <label class="label">Button Calculate</label>
                        <div class="control">
                            <input class="input is-link" type="text" placeholder="Enter text" value="Calculate"
                                   name="calculate">
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="field">
                        <label class="label">Button Reset</label>
                        <div class="control">
                            <input class="input is-link" name="reset" type="text" placeholder="Enter text"
                                   value="Reset">
                        </div>
                    </div>
                </div>
            </div>

            <div class="columns">
                <div class="column has-text-centered">
                    <button class="button-add button is-success is-radiusless" name="add-field">Add Field</button>
                    <button class="button-update button is-success is-hidden is-radiusless" name="update-field">Update Field</button>
                </div>
            </div>

        </form>
    </div>

</div>

