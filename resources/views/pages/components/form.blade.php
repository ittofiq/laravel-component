@extends('layouts.app')
@section('title', 'Form Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'form'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">📝 Form Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">27 komponen: Input, Password Input, OTP Input, Chip Input, Range Slider, Input Group, Floating Label, Textarea, Select, Checkbox, Radio, Toggle, Date Input, Time Input, DateTime Input, Date Picker, Auto-Complete, Multi-Select, Image Uploader, Color Picker, File Upload, Styled File Input, Search Input, Combobox, Form Wizard, Rating Input, Rich Text Editor</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <x-ui.demo-card title="Input" component="form.input" :props="[
                ['name' => 'type', 'type' => 'string', 'default' => '\'text\'', 'description' => 'Tipe input HTML'],
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null', 'description' => 'Nama field'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null', 'description' => 'Label'],
                ['name' => 'placeholder', 'type' => 'string|null', 'default' => 'null', 'description' => 'Placeholder'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false', 'description' => 'Wajib diisi'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false', 'description' => 'Nonaktif'],
                ['name' => 'error', 'type' => 'string|null', 'default' => 'null', 'description' => 'Pesan error'],
            ]">
                <x-form.input name="basic" placeholder="Basic input" />
                <x-form.input name="labeled" label="Email" type="email" placeholder="test@example.com" class="mt-3" />
                <x-form.input name="required" label="Username" required placeholder="Enter username" class="mt-3" />
                <x-form.input name="disabled" label="Disabled" disabled placeholder="This is disabled" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.input name="i_xs" placeholder="Extra small" size="xs" />
                        <x-form.input name="i_sm" placeholder="Small" size="sm" />
                        <x-form.input name="i_md" placeholder="Medium" size="md" />
                        <x-form.input name="i_lg" placeholder="Large" size="lg" />
                        <x-form.input name="i_xl" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Textarea" component="form.textarea" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'placeholder', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'rows', 'type' => 'int', 'default' => '4', 'description' => 'Jumlah baris'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'error', 'type' => 'string|null', 'default' => 'null'],
            ]">
                <x-form.textarea name="basic" placeholder="Basic textarea" />
                <x-form.textarea name="labeled" label="Message" placeholder="Your message..." class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.textarea name="t_xs" placeholder="Extra small" size="xs" rows="2" />
                        <x-form.textarea name="t_sm" placeholder="Small" size="sm" rows="2" />
                        <x-form.textarea name="t_md" placeholder="Medium" size="md" rows="2" />
                        <x-form.textarea name="t_lg" placeholder="Large" size="lg" rows="2" />
                        <x-form.textarea name="t_xl" placeholder="Extra large" size="xl" rows="2" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Select" component="form.select" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'options', 'type' => 'array', 'default' => '[]', 'description' => 'value => label'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Pilih opsi...\''],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.select name="option" label="Choose" :options="['a' => 'Option A', 'b' => 'Option B', 'c' => 'Option C']" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.select name="s_xs" :options="['a' => 'Extra small']" size="xs" />
                        <x-form.select name="s_sm" :options="['a' => 'Small']" size="sm" />
                        <x-form.select name="s_md" :options="['a' => 'Medium']" size="md" />
                        <x-form.select name="s_lg" :options="['a' => 'Large']" size="lg" />
                        <x-form.select name="s_xl" :options="['a' => 'Extra large']" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Checkbox & Radio" component="form.checkbox" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'value', 'type' => 'string', 'default' => '\'1\''],
                ['name' => 'checked', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.checkbox name="agree" label="I agree to terms" />
                <x-form.radio name="choice" value="yes" label="Yes" class="mt-3" />
                <x-form.radio name="choice" value="no" label="No" class="mt-1" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="grid grid-cols-2 gap-2">
                        <x-form.checkbox name="cb_xs" label="Extra small" size="xs" />
                        <x-form.radio name="rd_xs" value="xs" label="Extra small" size="xs" />
                        <x-form.checkbox name="cb_sm" label="Small" size="sm" />
                        <x-form.radio name="rd_sm" value="sm" label="Small" size="sm" />
                        <x-form.checkbox name="cb_md" label="Medium" size="md" />
                        <x-form.radio name="rd_md" value="md" label="Medium" size="md" />
                        <x-form.checkbox name="cb_lg" label="Large" size="lg" />
                        <x-form.radio name="rd_lg" value="lg" label="Large" size="lg" />
                        <x-form.checkbox name="cb_xl" label="Extra large" size="xl" />
                        <x-form.radio name="rd_xl" value="xl" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Toggle / Switch" component="form.toggle" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'checked', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'blue, green, red, purple'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.toggle name="notifications" label="Enable Notifications" :checked="true" />
                <x-form.toggle name="dark_mode" label="Dark Mode" color="green" class="mt-3" />
                <x-form.toggle name="disabled_toggle" label="Disabled" disabled class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="flex flex-wrap gap-3 items-center">
                        <x-form.toggle name="t_xs" size="xs" />
                        <x-form.toggle name="t_sm" size="sm" />
                        <x-form.toggle name="t_md" size="md" />
                        <x-form.toggle name="t_lg" size="lg" />
                        <x-form.toggle name="t_xl" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Password Input" component="form.password-input" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'password\''],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Masukkan password\''],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.password-input name="password" label="Password" />
                <x-form.password-input name="err" label="Error State" error="Password minimal 8 karakter" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.password-input name="p_xs" placeholder="Extra small" size="xs" />
                        <x-form.password-input name="p_sm" placeholder="Small" size="sm" />
                        <x-form.password-input name="p_md" placeholder="Medium" size="md" />
                        <x-form.password-input name="p_lg" placeholder="Large" size="lg" />
                        <x-form.password-input name="p_xl" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="OTP Input" component="form.otp-input" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'otp\''],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'length', 'type' => 'int', 'default' => '6', 'description' => 'Jumlah digit'],
                ['name' => 'error', 'type' => 'string|null', 'default' => 'null'],
            ]">
                <x-form.otp-input name="code" label="Verification Code" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-3">
                        <x-form.otp-input name="o_xs" size="xs" />
                        <x-form.otp-input name="o_sm" size="sm" />
                        <x-form.otp-input name="o_md" size="md" />
                        <x-form.otp-input name="o_lg" size="lg" />
                        <x-form.otp-input name="o_xl" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Input Group" component="form.input-group" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'prefix', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks prefix (https://)'],
                ['name' => 'suffix', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks suffix (.00)'],
                ['name' => 'prefixIcon', 'type' => 'string|null', 'default' => 'null', 'description' => 'Ikon prefix'],
                ['name' => 'suffixIcon', 'type' => 'string|null', 'default' => 'null', 'description' => 'Ikon suffix'],
            ]">
                <x-form.input-group name="url" label="URL" prefix="https://" placeholder="example.com" />
                <x-form.input-group name="price" label="Price" prefix="$" suffix=".00" placeholder="0" class="mt-3" />
                <x-form.input-group name="email" label="Email" suffixIcon="📧" placeholder="your@email.com" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.input-group name="ig_xs" prefix="@" placeholder="Extra small" size="xs" />
                        <x-form.input-group name="ig_sm" prefix="@" placeholder="Small" size="sm" />
                        <x-form.input-group name="ig_md" prefix="@" placeholder="Medium" size="md" />
                        <x-form.input-group name="ig_lg" prefix="@" placeholder="Large" size="lg" />
                        <x-form.input-group name="ig_xl" prefix="@" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Floating Label" component="form.floating-label" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string', 'default' => '\'Label\''],
                ['name' => 'type', 'type' => 'string', 'default' => '\'text\''],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.floating-label name="email" label="Email Address" type="email" />
                <x-form.floating-label name="password" label="Password" type="password" class="mt-4" />
                <x-form.floating-label name="username" label="Username" :required="true" class="mt-4" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.floating-label name="fl_xs" label="Extra small" size="xs" />
                        <x-form.floating-label name="fl_sm" label="Small" size="sm" />
                        <x-form.floating-label name="fl_md" label="Medium" size="md" />
                        <x-form.floating-label name="fl_lg" label="Large" size="lg" />
                        <x-form.floating-label name="fl_xl" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Range Slider" component="form.range-slider" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'min', 'type' => 'int', 'default' => '0'],
                ['name' => 'max', 'type' => 'int', 'default' => '100'],
                ['name' => 'step', 'type' => 'int', 'default' => '1'],
                ['name' => 'value', 'type' => 'int|null', 'default' => 'null'],
                ['name' => 'values', 'type' => 'array|null', 'default' => 'null', 'description' => '[min, max] untuk dual handle'],
            ]">
                <x-form.range-slider name="volume" label="Volume" :value="65" />
                <x-form.range-slider name="price" label="Price Range" :values="[25, 75]" :min="0" :max="100" class="mt-4" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-3">
                        <x-form.range-slider name="rs_xs" label="Extra small" :value="50" size="xs" />
                        <x-form.range-slider name="rs_sm" label="Small" :value="50" size="sm" />
                        <x-form.range-slider name="rs_md" label="Medium" :value="50" size="md" />
                        <x-form.range-slider name="rs_lg" label="Large" :value="50" size="lg" />
                        <x-form.range-slider name="rs_xl" label="Extra large" :value="50" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Rating Input" component="form.rating-input" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'value', 'type' => 'int', 'default' => '0'],
                ['name' => 'max', 'type' => 'int', 'default' => '5'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'color', 'type' => 'string', 'default' => '\'yellow\''],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.rating-input name="rating" label="Product Rating" :value="3" />
                <x-form.rating-input name="satisfaction" label="Satisfaction" :value="4" color="green" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.rating-input name="r_xs" :value="4" size="xs" />
                        <x-form.rating-input name="r_sm" :value="4" size="sm" />
                        <x-form.rating-input name="r_md" :value="4" size="md" />
                        <x-form.rating-input name="r_lg" :value="4" size="lg" />
                        <x-form.rating-input name="r_xl" :value="4" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Date Picker" component="form.date-picker" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.date-picker name="birthdate" label="Tanggal Lahir" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.date-picker name="dp_xs" label="Extra small" size="xs" />
                        <x-form.date-picker name="dp_sm" label="Small" size="sm" />
                        <x-form.date-picker name="dp_md" label="Medium" size="md" />
                        <x-form.date-picker name="dp_lg" label="Large" size="lg" />
                        <x-form.date-picker name="dp_xl" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Auto-Complete" component="form.auto-complete" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'options', 'type' => 'array', 'default' => '[]'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.auto-complete name="language" :options="['JavaScript', 'Python', 'PHP', 'Java', 'Go', 'Rust', 'TypeScript']" label="Language" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.auto-complete name="ac_xs" :options="['Option A']" label="Extra small" size="xs" />
                        <x-form.auto-complete name="ac_sm" :options="['Option A']" label="Small" size="sm" />
                        <x-form.auto-complete name="ac_md" :options="['Option A']" label="Medium" size="md" />
                        <x-form.auto-complete name="ac_lg" :options="['Option A']" label="Large" size="lg" />
                        <x-form.auto-complete name="ac_xl" :options="['Option A']" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Chip Input" component="form.chip-input" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'chips', 'type' => 'array', 'default' => '[]', 'description' => 'Chip awal'],
                ['name' => 'maxChips', 'type' => 'int|null', 'default' => 'null'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '—'],
            ]">
                <x-form.chip-input name="tags" label="Tags" placeholder="Add tag..." :maxChips="5" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.chip-input name="ci_xs" placeholder="Extra small" size="xs" />
                        <x-form.chip-input name="ci_sm" placeholder="Small" size="sm" />
                        <x-form.chip-input name="ci_md" placeholder="Medium" size="md" />
                        <x-form.chip-input name="ci_lg" placeholder="Large" size="lg" />
                        <x-form.chip-input name="ci_xl" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Multi-Select" component="form.multi-select" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'options', 'type' => 'array', 'default' => '[]', 'description' => 'value => label'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Cari dan pilih opsi...\''],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.multi-select name="skills" label="Skills" :options="['js' => 'JavaScript', 'php' => 'PHP', 'python' => 'Python']" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.multi-select name="ms_xs" :options="['a' => 'Option A']" placeholder="Extra small" size="xs" />
                        <x-form.multi-select name="ms_sm" :options="['a' => 'Option A']" placeholder="Small" size="sm" />
                        <x-form.multi-select name="ms_md" :options="['a' => 'Option A']" placeholder="Medium" size="md" />
                        <x-form.multi-select name="ms_lg" :options="['a' => 'Option A']" placeholder="Large" size="lg" />
                        <x-form.multi-select name="ms_xl" :options="['a' => 'Option A']" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Color Picker" component="form.color-picker" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'value', 'type' => 'string', 'default' => '\'#3B82F6\''],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.color-picker name="color" label="Pick Color" value="#3B82F6" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.color-picker name="cp_xs" label="Extra small" size="xs" />
                        <x-form.color-picker name="cp_sm" label="Small" size="sm" />
                        <x-form.color-picker name="cp_md" label="Medium" size="md" />
                        <x-form.color-picker name="cp_lg" label="Large" size="lg" />
                        <x-form.color-picker name="cp_xl" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="File Upload" component="form.file-upload" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'accept', 'type' => 'string', 'default' => '\'*\''],
                ['name' => 'multiple', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.file-upload name="file" label="Upload File" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Search Input" component="form.search-input" :props="[
                ['name' => 'name', 'type' => 'string', 'default' => '\'search\''],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Cari...\''],
                ['name' => 'suggestions', 'type' => 'array', 'default' => '[]'],
            ]">
                <x-form.search-input name="search" label="Search" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.search-input name="si_xs" placeholder="Extra small" size="xs" />
                        <x-form.search-input name="si_sm" placeholder="Small" size="sm" />
                        <x-form.search-input name="si_md" placeholder="Medium" size="md" />
                        <x-form.search-input name="si_lg" placeholder="Large" size="lg" />
                        <x-form.search-input name="si_xl" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Combobox" component="form.combobox" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'options', 'type' => 'array', 'default' => '[]'],
                ['name' => 'searchable', 'type' => 'bool', 'default' => 'true'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.combobox name="category" label="Category" :options="['Design', 'Development', 'Marketing', 'Sales']" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.combobox name="cb_xs" :options="['Option A']" label="Extra small" size="xs" />
                        <x-form.combobox name="cb_sm" :options="['Option A']" label="Small" size="sm" />
                        <x-form.combobox name="cb_md" :options="['Option A']" label="Medium" size="md" />
                        <x-form.combobox name="cb_lg" :options="['Option A']" label="Large" size="lg" />
                        <x-form.combobox name="cb_xl" :options="['Option A']" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Form Wizard" component="form.form-wizard" :props="[
                ['name' => 'steps', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar langkah'],
                ['name' => 'currentStep', 'type' => 'int', 'default' => '1'],
            ]">
                <x-form.form-wizard :steps="['Account', 'Profile', 'Confirmation']" :currentStep="2" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Rich Text Editor" component="form.rich-text-editor" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'rows', 'type' => 'int', 'default' => '10'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'Ketik di sini...\''],
            ]">
                <x-form.rich-text-editor name="content" label="Content" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.rich-text-editor name="rte_xs" label="Extra small" size="xs" :rows="2" />
                        <x-form.rich-text-editor name="rte_sm" label="Small" size="sm" :rows="2" />
                        <x-form.rich-text-editor name="rte_md" label="Medium" size="md" :rows="2" />
                        <x-form.rich-text-editor name="rte_lg" label="Large" size="lg" :rows="2" />
                        <x-form.rich-text-editor name="rte_xl" label="Extra large" size="xl" :rows="2" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Currency Input" component="form.currency-input" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'currency', 'type' => 'string', 'default' => '\'IDR\''],
                ['name' => 'locale', 'type' => 'string', 'default' => '\'id-ID\''],
            ]">
                <x-form.currency-input name="price" label="Harga (IDR)" currency="IDR" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.currency-input name="cu_xs" placeholder="0" size="xs" />
                        <x-form.currency-input name="cu_sm" placeholder="0" size="sm" />
                        <x-form.currency-input name="cu_md" placeholder="0" size="md" />
                        <x-form.currency-input name="cu_lg" placeholder="0" size="lg" />
                        <x-form.currency-input name="cu_xl" placeholder="0" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Phone Input" component="form.phone-input" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'placeholder', 'type' => 'string', 'default' => '\'81234567890\''],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
                ['name' => 'disabled', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.phone-input name="phone" label="Phone Number" placeholder="81234567890" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.phone-input name="ph_xs" placeholder="Extra small" size="xs" />
                        <x-form.phone-input name="ph_sm" placeholder="Small" size="sm" />
                        <x-form.phone-input name="ph_md" placeholder="Medium" size="md" />
                        <x-form.phone-input name="ph_lg" placeholder="Large" size="lg" />
                        <x-form.phone-input name="ph_xl" placeholder="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Date & Time Input" component="form.date-input" :props="[
                ['name' => 'name', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null'],
                ['name' => 'required', 'type' => 'bool', 'default' => 'false'],
            ]">
                <x-form.date-input name="date" label="Date" />
                <x-form.time-input name="time" label="Time" class="mt-3" />
                <x-form.datetime-input name="datetime" label="DateTime" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-form.date-input name="d_xs" label="Extra small" size="xs" />
                        <x-form.date-input name="d_sm" label="Small" size="sm" />
                        <x-form.date-input name="d_md" label="Medium" size="md" />
                        <x-form.date-input name="d_lg" label="Large" size="lg" />
                        <x-form.date-input name="d_xl" label="Extra large" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">📋 Form Layout Examples</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Login</h3>
                    <div class="max-w-sm mx-auto">
                        <form class="space-y-3">
                            <x-form.input-group name="email2" prefixIcon="📧" placeholder="Email address" />
                            <x-form.input-group name="pass" prefixIcon="🔒" placeholder="Password" />
                            <x-form.checkbox name="remember" label="Remember me" />
                            <x-ui.button variant="primary" class="w-full justify-center">Sign In</x-ui.button>
                        </form>
                    </div>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Form Layout — Inline</h3>
                    <form class="flex items-end gap-3">
                        <div class="flex-1 min-w-[140px]"><x-form.input name="city" placeholder="City" /></div>
                        <div class="flex-1 min-w-[140px]"><x-form.input name="type" placeholder="Type" /></div>
                        <div class="flex-1 min-w-[140px]"><x-ui.button variant="primary">Search</x-ui.button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection