import classnames from 'classnames';

import CallToAction_1_5_2 from './1.5.2/components/cta';
import CallToAction_1_4_22 from './1.4.22/components/cta';
import CallToAction_1_4_21 from './1.4.21/components/cta';

const { RichText } = wp.blockEditor;

export const callToAction_1_5_2_attr = {
	buttonText: {
		type: 'string',
	},
	buttonUrl: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
	},
	buttonAlignment: {
		type: 'string',
		default: 'center',
	},
	buttonBackgroundColor: {
		type: 'string',
		default: '#3373dc',
	},
	buttonTextColor: {
		type: 'string',
		default: '#ffffff',
	},
	buttonSize: {
		type: 'string',
		default: 'gb-button-size-medium',
	},
	buttonShape: {
		type: 'string',
		default: 'gb-button-shape-rounded',
	},
	buttonTarget: {
		type: 'boolean',
		default: false,
	},
	ctaTitle: {
		type: 'array',
		selector: '.gb-cta-title',
		source: 'children',
	},
	titleFontSize: {
		type: 'number',
		default: '32',
	},
	ctaTextFontSize: {
		type: 'number',
	},
	ctaText: {
		type: 'array',
		selector: '.gb-cta-text',
		source: 'children',
	},
	ctaWidth: {
		type: 'string',
	},
	ctaBackgroundColor: {
		type: 'string',
	},
	ctaTextColor: {
		type: 'string',
		default: '#32373c',
	},
	imgURL: {
		type: 'string',
		source: 'attribute',
		attribute: 'src',
		selector: 'img',
	},
	imgID: {
		type: 'number',
	},
	imgAlt: {
		type: 'string',
		source: 'attribute',
		attribute: 'alt',
		selector: 'img',
	},
	dimRatio: {
		type: 'number',
		default: 50,
	},

	// Deprecated
	ctaTitleFontSize: {
		type: 'string',
		default: '32',
	},
};

const callToAction_2_0_0_save = ( props ) => {
	const {
		buttonText,
		buttonUrl,
		buttonBackgroundColor,
		buttonTextColor,
		buttonSize,
		buttonShape,
		buttonTarget,
		ctaTitle,
		ctaText,
		ctaTitleFontSize,
		titleFontSize,
		ctaTextColor,
		imgURL,
		imgAlt,
		dimRatio,
	} = props.attributes;

	// Still using CallToAction_1_5_2, as there was no change since 1.5.2.
	return (
		<CallToAction_1_5_2 { ...props }>
			{ imgURL && !! imgURL.length && (
				<div className="gb-cta-image-wrap">
					<img
						className={ classnames(
							'gb-cta-image',
							dimRatioToClass( dimRatio ),
							{
								'has-background-dim': 0 !== dimRatio,
							}
						) }
						src={ imgURL }
						alt={ imgAlt }
					/>
				</div>
			) }

			<div className="gb-cta-content">
				{ ctaTitle && (
					<RichText.Content
						tagName="h2"
						className={ classnames(
							'gb-cta-title',
							'gb-font-size-' + titleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaTitle }
					/>
				) }
				{ ctaText && (
					<RichText.Content
						tagName="div"
						className={ classnames(
							'gb-cta-text',
							'gb-font-size-' + ctaTitleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaText }
					/>
				) }
			</div>
			{ buttonText && (
				<div className="gb-cta-button">
					<a
						href={ buttonUrl }
						target={ buttonTarget ? '_blank' : '_self' }
						rel="noopener noreferrer"
						className={ classnames(
							'gb-button',
							buttonShape,
							buttonSize
						) }
						style={ {
							color: buttonTextColor,
							backgroundColor: buttonBackgroundColor,
						} }
					>
						<RichText.Content value={ buttonText } />
					</a>
				</div>
			) }
		</CallToAction_1_5_2>
	);
}

export const callToAction_1_5_2_save = ( props ) => {
	const {
		buttonText,
		buttonUrl,
		buttonAlignment,
		buttonBackgroundColor,
		buttonTextColor,
		buttonSize,
		buttonShape,
		buttonTarget,
		ctaTitle,
		ctaText,
		ctaTitleFontSize,
		titleFontSize,
		ctaTextFontSize,
		ctaWidth,
		ctaBackgroundColor,
		ctaTextColor,
		imgURL,
		imgID,
		imgAlt,
		dimRatio,
	} = props.attributes;

	return (
		<CallToAction_1_5_2 { ...props }>
			{ imgURL && !! imgURL.length && (
				<div className="gb-cta-image-wrap">
					<img
						className={ classnames(
							'gb-cta-image',
							dimRatioToClass( dimRatio ),
							{
								'has-background-dim': 0 !== dimRatio,
							}
						) }
						src={ imgURL }
						alt={ imgAlt }
					/>
				</div>
			) }

			<div className="gb-cta-content">
				{ ctaTitle && (
					<RichText.Content
						tagName="h2"
						className={ classnames(
							'gb-cta-title',
							'gb-font-size-' + titleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaTitle }
					/>
				) }
				{ ctaText && (
					<RichText.Content
						tagName="div"
						className={ classnames(
							'gb-cta-text',
							'gb-font-size-' + ctaTitleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaText }
					/>
				) }
			</div>
			{ buttonText && (
				<div className="gb-cta-button">
					<a
						href={ buttonUrl }
						target={ buttonTarget ? '_blank' : '_self' }
						rel={ buttonTarget ? 'noopener noreferrer' : null }
						className={ classnames(
							'gb-button',
							buttonShape,
							buttonSize
						) }
						style={ {
							color: buttonTextColor,
							backgroundColor: buttonBackgroundColor,
						} }
					>
						<RichText.Content value={ buttonText } />
					</a>
				</div>
			) }
		</CallToAction_1_5_2>
	);
};

// Version 1_4_22 attributes

export const callToAction_1_4_22_attr = {
	buttonText: {
		type: 'string',
	},
	buttonUrl: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
	},
	buttonAlignment: {
		type: 'string',
		default: 'center',
	},
	buttonBackgroundColor: {
		type: 'string',
		default: '#3373dc',
	},
	buttonTextColor: {
		type: 'string',
		default: '#ffffff',
	},
	buttonSize: {
		type: 'string',
		default: 'gb-button-size-medium',
	},
	buttonShape: {
		type: 'string',
		default: 'gb-button-shape-rounded',
	},
	buttonTarget: {
		type: 'boolean',
		default: false,
	},
	ctaTitle: {
		type: 'array',
		selector: '.gb-cta-title',
		source: 'children',
	},
	titleFontSize: {
		type: 'number',
		default: '32',
	},
	ctaTextFontSize: {
		type: 'number',
	},
	ctaText: {
		type: 'array',
		selector: '.gb-cta-text',
		source: 'children',
	},
	ctaWidth: {
		type: 'string',
		default: 'center',
	},
	ctaBackgroundColor: {
		type: 'string',
	},
	ctaTextColor: {
		type: 'string',
		default: '#32373c',
	},
	imgURL: {
		type: 'string',
		source: 'attribute',
		attribute: 'src',
		selector: 'img',
	},
	imgID: {
		type: 'number',
	},
	imgAlt: {
		type: 'string',
		source: 'attribute',
		attribute: 'alt',
		selector: 'img',
	},
	dimRatio: {
		type: 'number',
		default: 50,
	},

	// Deprecated
	ctaTitleFontSize: {
		type: 'string',
		default: '32',
	},
};

// Version 1_4_22 save

export const callToAction_1_4_22_save = ( props ) => {
	const {
		buttonText,
		buttonUrl,
		buttonAlignment,
		buttonBackgroundColor,
		buttonTextColor,
		buttonSize,
		buttonShape,
		buttonTarget,
		ctaTitle,
		ctaText,
		ctaTitleFontSize,
		ctaTextFontSize,
		ctaWidth,
		ctaBackgroundColor,
		ctaTextColor,
		imgURL,
		imgID,
		imgAlt,
		dimRatio,
	} = props.attributes;

	return (
		<CallToAction_1_4_22 { ...props }>
			{ imgURL && !! imgURL.length && (
				<div className="gb-cta-image-wrap">
					<img
						className={ classnames(
							'gb-cta-image',
							dimRatioToClass( dimRatio ),
							{
								'has-background-dim': 0 !== dimRatio,
							}
						) }
						src={ imgURL }
						alt={ imgAlt }
					/>
				</div>
			) }

			<div className="gb-cta-content">
				{ ctaTitle && (
					<RichText.Content
						tagName="h2"
						className={ classnames(
							'gb-cta-title',
							'gb-font-size-' + ctaTitleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaTitle }
					/>
				) }
				{ ctaText && (
					<RichText.Content
						tagName="div"
						className={ classnames(
							'gb-cta-text',
							'gb-font-size-' + ctaTextFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaText }
					/>
				) }
			</div>
			{ buttonText && (
				<div className="gb-cta-button">
					<a
						href={ buttonUrl }
						target={ buttonTarget ? '_blank' : '_self' }
						rel={ buttonTarget ? 'noopener noreferrer' : null }
						className={ classnames(
							'gb-button',
							buttonShape,
							buttonSize
						) }
						style={ {
							color: buttonTextColor,
							backgroundColor: buttonBackgroundColor,
						} }
					>
						<RichText.Content value={ buttonText } />
					</a>
				</div>
			) }
		</CallToAction_1_4_22>
	);
};

// Version 1_4_21 attributes

export const callToAction_1_4_21_attr = {
	buttonText: {
		type: 'string',
	},
	buttonUrl: {
		type: 'string',
		source: 'attribute',
		selector: 'a',
		attribute: 'href',
	},
	buttonAlignment: {
		type: 'string',
		default: 'center',
	},
	buttonBackgroundColor: {
		type: 'string',
		default: '#3373dc',
	},
	buttonTextColor: {
		type: 'string',
		default: '#ffffff',
	},
	buttonSize: {
		type: 'string',
		default: 'gb-button-size-medium',
	},
	buttonShape: {
		type: 'string',
		default: 'gb-button-shape-rounded',
	},
	buttonTarget: {
		type: 'boolean',
		default: false,
	},
	ctaTitle: {
		type: 'array',
		selector: '.gb-cta-title',
		source: 'children',
	},
	ctaTitleFontSize: {
		type: 'string',
		default: '32',
	},
	ctaTextFontSize: {
		type: 'string',
		default: '20',
	},
	ctaText: {
		type: 'array',
		selector: '.gb-cta-text',
		source: 'children',
	},
	ctaWidth: {
		type: 'string',
		default: 'center',
	},
	ctaBackgroundColor: {
		type: 'string',
		default: '#f2f2f2',
	},
	ctaTextColor: {
		type: 'string',
		default: '#32373c',
	},
	imgURL: {
		type: 'string',
		source: 'attribute',
		attribute: 'src',
		selector: 'img',
	},
	imgID: {
		type: 'number',
	},
	imgAlt: {
		type: 'string',
		source: 'attribute',
		attribute: 'alt',
		selector: 'img',
	},
	dimRatio: {
		type: 'number',
		default: 50,
	},
};

// Version 1_4_21 save

export const callToAction_1_4_21_save = ( props ) => {
	const {
		buttonText,
		buttonUrl,
		buttonAlignment,
		buttonBackgroundColor,
		buttonTextColor,
		buttonSize,
		buttonShape,
		buttonTarget,
		ctaTitle,
		ctaText,
		ctaTitleFontSize,
		ctaTextFontSize,
		ctaWidth,
		ctaBackgroundColor,
		ctaTextColor,
		imgURL,
		imgID,
		imgAlt,
		dimRatio,
	} = props.attributes;

	return (
		<CallToAction_1_4_21 { ...props }>
			{ imgURL && !! imgURL.length && (
				<div className="gb-cta-image-wrap">
					<img
						className={ classnames(
							'gb-cta-image',
							dimRatioToClass( dimRatio ),
							{
								'has-background-dim': 0 !== dimRatio,
							}
						) }
						src={ imgURL }
						alt={ imgAlt }
					/>
				</div>
			) }

			<div className="gb-cta-content">
				{ ctaTitle && (
					<RichText.Content
						tagName="h2"
						className={ classnames(
							'gb-cta-title',
							'gb-font-size-' + ctaTitleFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaTitle }
					/>
				) }
				{ ctaText && (
					<RichText.Content
						tagName="div"
						className={ classnames(
							'gb-cta-text',
							'gb-font-size-' + ctaTextFontSize
						) }
						style={ {
							color: ctaTextColor,
						} }
						value={ ctaText }
					/>
				) }
			</div>
			{ buttonText && (
				<div className="gb-cta-button">
					<a
						href={ buttonUrl }
						target={ buttonTarget ? '_blank' : '_self' }
						className={ classnames(
							'gb-button',
							buttonShape,
							buttonSize
						) }
						style={ {
							color: buttonTextColor,
							backgroundColor: buttonBackgroundColor,
						} }
					>
						<RichText.Content value={ buttonText } />
					</a>
				</div>
			) }
		</CallToAction_1_4_21>
	);
};

// Build deprecated list

const deprecated = [
	// Version 2_0_0
	{
		attributes: callToAction_1_5_2_attr, // No change since 1.5.2.
		save: callToAction_2_0_0_save,
	},
	// Version 1_5_2
	{
		attributes: callToAction_1_5_2_attr,
		save: callToAction_1_5_2_save,
	},

	// Version 1_4_22
	{
		attributes: callToAction_1_4_22_attr,
		save: callToAction_1_4_22_save,
	},

	// Version 1_4_21
	{
		attributes: callToAction_1_4_21_attr,
		save: callToAction_1_4_21_save,
		migrate: ( attributes ) => {
			return {
				titleFontSize: attributes.ctaTitleFontSize,
				...attributes,
			};
		},
	},
];

export default deprecated;

// Image opacity function
function dimRatioToClass( ratio ) {
	return 0 === ratio || 50 === ratio
		? null
		: 'has-background-dim-' + 10 * Math.round( ratio / 10 );
}
